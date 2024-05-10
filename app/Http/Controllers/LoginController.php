<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $user = User::query()->where('email', $request->email)->first();
        if (is_null($user)) {
            return response()->json([
                'data' => [
                    'Status' => 'Usuario não encontrado!',
                ]
            ], 404);
        } else {
            if (Hash::check($request->password, $user->password)) {
                $credenciais = $request->only(['email', 'password',]);
                if (!$token = auth()->attempt($credenciais)) {
                    abort(401, 'Pode não!');
                }
                // Retornar todos os dados do usuário junto com o token
                return response()->json([
                    'token' => $token,
                    'user' => $user
                ], 200);
            } else {
                return response()->json([
                    'data' => [
                        'Status' => 'Senha incoreta!',
                    ]
                ], 401);
            }
        }
    }


    function getUserByToken()
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            return $user;
        } else {
            return response('Usuario não encontrado!', 404);
        }
    }

    public function tokenById(String $id)
    {

        $token =
            auth()->tokenById($id);
        return response()->json([
            'data' => [
                'Status' => 'Sucesso!',
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        ]);
    }

    public function logout()
    {
        try {
            auth()->logout();
            auth()->logout(true);
            return response('deslogado com sucesso!', 200);
        } catch (\Throwable $th) {
            return response('$th ', 401);
        }
    }
}
