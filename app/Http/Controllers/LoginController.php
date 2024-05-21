<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validação básica de campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::query()->where('email', $request->email)->first();

        if (is_null($user)) {
            return response()->json([
                'data' => [
                    'status' => 'Usuário não encontrado!',
                ]
            ], 404);
        }

        if (Hash::check($request->password, $user->password)) {
            $credentials = $request->only(['email', 'password']);

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            return response()->json([
                'token' => $token,
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    'status' => 'Senha incorreta!',
                ]
            ], 401);
        }
    }

    public function getUserByToken()
    {
        try {
            $user = Auth::guard('api')->user();

            if ($user) {
                return response()->json($user, 200);
            } else {
                return response()->json(['message' => 'Usuário não encontrado!'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar usuário'], 500);
        }
    }

    public function tokenById(String $id)
    {
        try {
            $user = User::findOrFail($id);
            $token = JWTAuth::fromUser($user);

            // Obter o tempo de expiração do token a partir da configuração
            $expires_in = config('jwt.ttl') * 60;

            return response()->json([
                'data' => [
                    'status' => 'Sucesso!',
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $expires_in,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao gerar token'], 500);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Deslogado com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao deslogar'], 500);
        }
    }
}
