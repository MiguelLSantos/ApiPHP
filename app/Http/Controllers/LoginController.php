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
                return response($token, 200);
            } else {
                return response()->json([
                    'data' => [
                        'Status' => 'Senha incoreta!',
                    ]
                ], 404);
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

        $token = auth()->tokenById($id);
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
        auth()->logout(true);
        return response()->json(['message' => 'Sucesso ao sair!']);
    }
}
