<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            abort(401, 'Invalid Credentials.');
        }

        $token = auth('sanctum')->user()->createToken('access_token');

        return response()->json([
            'user' => auth()->user(),
            'token' => $token->plainTextToken
        ]);
    }

    public function logout()
    {
        if (auth()->check()) {
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            auth()->logout();
        }

        return response()->noContent();
    }

    public function register(Request $request, User $user)
    {
        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData)) {
            abort(500, 'Error to create a new user.');
        }


        return response()->json(['data' => ['user' => $user]]);
    }
}
