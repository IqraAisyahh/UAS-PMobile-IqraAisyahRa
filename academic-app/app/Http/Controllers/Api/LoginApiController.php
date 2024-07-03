<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginApiController extends Controller
{
    /**
     * Login user.
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Jika validasi gagal, kembalikan respons error
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->accessToken;

            $response = [
                'status' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'nis' => $user->nis,
                    'roles' => $user->roles,  // Assuming roles is a relationship
                ],
                'token' => $token
            ];

            return response()->json($response, 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Login failed'], 401);
        }
    }

    /**
     * Logout user.
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil logout'
        ]);
    }

    /**
     * Register user.
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // Jika validasi gagal, kembalikan respons error
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan registrasi',
                'errors' => $validator->errors()
            ], 400);
        }

        // Buat data user baru
        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        // Simpan user baru ke dalam database
        $user = User::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil',
            'data' => $user
        ], 201);
    }

    
}
