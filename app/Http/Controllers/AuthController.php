<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = new User();

        $request->validate($user->loginRules(), $user->loginFeedbacks());
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

    public function register(Request $request)
    {
        $user = new User();

        $request->validate($user->rules(), $user->feedbacks());

        $userData = $request->only('first_name', 'last_name', 'email', 'password');
        $userData['password'] = bcrypt($userData['password']);

        $user->fill($userData);

        if (!$user->save()) {
            return response()->json(['message' => 'Não foi possível realizar o cadastro. Tente novamente mais tarde.'], 500);
        }

        return response()->json(['message' => 'Cadastro realizado com sucesso!'], 200);
    }
}
