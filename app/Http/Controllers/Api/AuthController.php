<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
            'email' => ['required','email'],
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('my-device');

            return response()->json([
                'token' => $token->plainTextToken, 
                'message' => 'Login success'
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid credentials. Please check your email and password.',
            'status' => 'error'
        ], 401);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
