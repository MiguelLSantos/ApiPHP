<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItenController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rotas de Usuário
Route::post('/createuser', [UserController::class, 'store']); // Cadastro
Route::get('/showuser', [UserController::class, 'index']);// Ver todos os usuários
Route::get('/showoneuser/{id}', [UserController::class, 'show']); // Ver apeans um usuário
Route::post('/login', [LoginController::class, 'login']); // Login
Route::post('/logout', [LoginController::class, 'logout']);// Logout
Route::get('/token/{id}', [LoginController::class, 'tokenById']);// Pega o token pelo id

// Rotas de Itens
Route::post('/createiten', [ItenController::class, 'store']);
Route::get('/showitens', [ItenController::class, 'index']);
Route::get('/showoneiten/{id}', [ItenController::class, 'show']);
Route::put('/editeiten/{id}', [ItenController::class, 'update']);
Route::delete('/deleteiten/{id}', [ItenController::class, 'destroy']);



// Verifica pelo token o usuário atual logado
Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
