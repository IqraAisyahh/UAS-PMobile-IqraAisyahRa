<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        $users = User::role(['guru', 'admin'])->with('roles')->get();
        return response()->json(['users' => $users], 200);
    }

    // Menampilkan detail pengguna berdasarkan ID
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching user: ' . $e->getMessage());
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    // Menambahkan pengguna baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $user->assignRole($request->roles);

            Log::info('User created successfully: ' . $user->id);

            return response()->json(['message' => 'User created successfully.', 'user' => $user], 201);
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create user.'], 500);
        }
    }

    // Mengupdate pengguna berdasarkan ID
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            $user->syncRoles($request->roles);

            Log::info('User updated successfully: ' . $user->id);

            return response()->json(['message' => 'User updated successfully.', 'user' => $user], 200);
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update user.'], 500);
        }
    }

    // Menghapus pengguna berdasarkan ID
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Log::info('User deleted successfully: ' . $id);

            return response()->json(['message' => 'User deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete user.'], 500);
        }
    }
}
