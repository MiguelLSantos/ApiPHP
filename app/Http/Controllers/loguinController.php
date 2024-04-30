<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class loguinController extends Controller
{

public function login(Request $request){
    $credentials = $request->only('email', 'password');
     $user = User::query()->where('email',$request->email)->first();
    if (is_null($user)){
            return 'Usuário não encontrado';
        }else{
            if(Hash::check($request->password,$user->password)){
                return 'Sucesso!';
            }else{
                return 'Senha incorreta';
            }
        }
    }
}
