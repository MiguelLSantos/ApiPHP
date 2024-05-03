<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItenController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rotas da empresa;
Route::post('/createempresa', [EmpresaController::class, 'store']); // Criação da empresa
Route::get('/showempresas', [EmpresaController::class, 'index']); // Ver todas as empresa
Route::get('/showoneempresa/{id}', [EmpresaController::class, 'show']); // Ver apeans uma empresa
Route::put('/editeempresa/{id}', [EmpresaController::class, 'update']); // Edita a empresa
Route::delete('/deleteempresa/{id}', [EmpresaController::class, 'destroy']); // Deleta a empresa
Route::get('/showoneempresaf/{id}', [EmpresaController::class, 'showFuncionarios']); // Ver todos os funcionarios da empresa


// Rotas de Usuário
Route::post('/createuser', [UserController::class, 'store']); // Cadastro
Route::post('/login', [LoginController::class, 'login']); // Login
Route::get('/token/{id}', [LoginController::class, 'tokenById']);// Pega o token pelo id

Route::group(['middleware' => ['apiJWT']], function(){
    Route::post('/logout', [LoginController::class, 'logout']);// Logout
    Route::get('/showuser', [UserController::class, 'index']);// Ver todos os usuários
    Route::get('/showoneuser/{id}', [UserController::class, 'show']); // Ver apeans um usuário
    // Rotas de Itens
    Route::post('/createiten', [ItenController::class, 'store']); // Criação de iten
    Route::get('/showitens', [ItenController::class, 'index']);// Ver todos os itens
    Route::get('/showoneiten/{id}', [ItenController::class, 'show']);// Ver apeans um iten
    Route::put('/editeiten/{id}', [ItenController::class, 'update']); // Edita o iten
    Route::delete('/deleteiten/{id}', [ItenController::class, 'destroy']);// Deleta o iten
});




// Verifica pelo token o usuário atual logado
Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
