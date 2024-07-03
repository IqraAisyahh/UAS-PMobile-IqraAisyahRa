<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Tambahkan use statement untuk Log
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Middleware untuk otorisasi
    public function __construct()
    {
        $this->middleware('auth'); // Hanya pengguna yang terotentikasi dapat mengakses method di controller ini
    }

    // Menampilkan daftar pengguna
    public function index()
    {
         $users = User::role(['guru', 'admin'])->with('roles')->get();
        return view('user.index', compact('users'));
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        $roles = Role::all(); // Memuat semua peran
        $user = null; // Inisialisasi $user dengan null untuk menunjukkan ini adalah form tambah
        return view('user.create', compact('user', 'roles'));
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $user->assignRole($request->roles);

            Log::info('User created successfully: '.$user->id);

            return redirect()->route('admin.user.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            // Tangkap error dan log pesan kesalahan
            Log::error('Error creating user: '.$e->getMessage());

            // Redirect dengan pesan kesalahan
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Memperbarui pengguna
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required'
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            $user->syncRoles($request->roles);

            Log::info('User updated successfully: '.$user->id);

            return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            // Tangkap error dan log pesan kesalahan
            Log::error('Error updating user: '.$e->getMessage());

            // Redirect dengan pesan kesalahan
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Log::info('User deleted successfully: '.$id);

            return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Tangkap error dan log pesan kesalahan
            Log::error('Error deleting user: '.$e->getMessage());

            // Redirect dengan pesan kesalahan
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

