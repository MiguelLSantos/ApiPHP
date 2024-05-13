<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItenController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Rodar a API assim
// php artisan serve --host=0.0.0.0 --port=8000
// Colocar o ip de minha maquina
// Rotas da empresa;
Route::post('/createempresa', [EmpresaController::class, 'store']); // Criação da empresa
Route::get('/showempresas', [EmpresaController::class, 'index']); // Ver todas as empresa
Route::get('/showoneempresa/{id}', [EmpresaController::class, 'show']); // Ver apeans uma empresa
Route::put('/editeempresa/{id}', [EmpresaController::class, 'update']); // Edita a empresa
Route::delete('/deleteempresa/{id}', [EmpresaController::class, 'destroy']); // Deleta a empresa
Route::get('/pdf/{id}', [ItenController::class, 'gerarPDF']); // Gera o PDF dos itens

// Rotas de Usuário
Route::post('/createuser', [UserController::class, 'store']); // Cadastro
Route::post('/login', [LoginController::class, 'login']); // Login
Route::get('/token/{id}', [LoginController::class, 'tokenById']); // Pega o token pelo id
Route::group(['middleware' => ['apiJWT']], function () {

    Route::put('/edituser/{id}', [UserController::class, 'update']); // Edita o funcionario
    Route::get('/showoneempresafg/{id}', [EmpresaController::class, 'showFuncionariosGerentes']); // Ver todos os funcionarios gerentes da empresa
    Route::get('/showoneempresaf/{id}', [EmpresaController::class, 'showFuncionarios']); // Ver todos os funcionarios da empresa
    Route::get('/showoneempresai/{id}', [EmpresaController::class, 'showItens']); // Ver todos os itens da empresa
    Route::get('/tokenuser', [LoginController::class, 'getUserByToken']);
    Route::get('/showouseri/{id}', [UserController::class, 'showItens']); // Ver todos os itens do usuário
    Route::post('/logout', [LoginController::class, 'logout']); // Logout
    Route::get('/showuser', [UserController::class, 'index']); // Ver todos os usuários
    Route::get('/showoneuser/{id}', [UserController::class, 'show']); // Ver apeans um usuário
    Route::delete('/deleteuser/{id}', [UserController::class, 'destroy']); // Deleta um usuário
    // Rotas de Itens
    Route::post('/createiten/{id}', [ItenController::class, 'store']); // Criação de iten
    Route::get('/showitens', [ItenController::class, 'index']); // Ver todos os itens
    Route::get('/showoneiten/{id}', [ItenController::class, 'show']); // Ver apeans um iten
    Route::put('/editeiten/{id}', [ItenController::class, 'update']); // Edita o iten
    Route::delete('/deleteiten/{id}', [ItenController::class, 'destroy']); // Deleta o iten
});




// Verifica pelo token o usuário atual logado
Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
