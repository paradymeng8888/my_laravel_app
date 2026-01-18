<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * ✅ REGISTER (Sanctum – Cloud safe)
     */
    public function register(Request $request)
    {
        try {
            // ✅ Validation (Laravel native, auto JSON)
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4',
            ]);

            // ✅ Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
            ], 201);

        } catch (\Throwable $e) {
            // 🔥 This prevents silent 500 on Cloud
            return response()->json([
                'message' => 'Register failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ✅ LOGIN (Sanctum)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
        }

        $user = $request->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * ✅ LOGOUT (Sanctum)
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json([
                'message' => 'Logged out successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
