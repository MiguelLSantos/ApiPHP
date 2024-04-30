<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItenController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rotas de Usuário
Route::post('/createuser', [UserController::class, 'store']);
Route::get('/showuser', [UserController::class, 'index']);
Route::get('/showoneuser/{id}', [UserController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);

// Rotas de Itens
Route::post('/createiten', [ItenController::class, 'store']);
Route::get('/showitens', [ItenController::class, 'index']);
Route::get('/showoneiten/{id}', [ItenController::class, 'show']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
