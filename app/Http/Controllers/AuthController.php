<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'con' => false,
                'message' => 'Invalid phone or password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        return response()->json([
            'con' => true,
            'message' => 'Login successful',
            'data' => $user,
        ], Response::HTTP_OK);
    }
}

