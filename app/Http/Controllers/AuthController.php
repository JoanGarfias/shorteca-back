<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ]);
        $user = Auth::attempt($validatedData);
        if ($user) {
            $request->session()->regenerate();
            return response()->json([
                'message' => 'Logged in successfully',
                'user' => Auth::user()
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json([
            'user' => $user,
        ], 200);
    }

    public function who(Request $request){
        $user = Auth::user();
        return response()->json([
            'user' => $user,
        ], 200);
    }
}
