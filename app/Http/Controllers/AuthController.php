<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user_rules = User::rules();
        $user_feedbacks = User::feedbacks();

        $rules['email'] = $user_rules['email'];
        $rules['password'] = $user_rules['password'];

        $feedbacks['email'] = $user_feedbacks['email'];
        $feedbacks['password'] = $user_feedbacks['password'];

        $request->validate($rules, $feedbacks);

        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Login ou senha incorreto(s).'], 401);
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
