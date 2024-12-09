<?php

use App\Http\Controllers\Auth\FuncionarioAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::post('/clientes/login', [AuthController::class, 'loginCliente']);
Route::post('/admins/login', [AuthController::class, 'loginFuncionario']);

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);

Route::post('/clientes', [ClienteController::class, 'store']);

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Clientes
    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

    // Funcionarios
    Route::get('/admins', [FuncionarioController::class, 'index']);
    Route::get('/admins/{id}', [FuncionarioController::class, 'show']);
    Route::post('/admins', [FuncionarioController::class, 'store']);
    Route::put('/admins/{id}', [FuncionarioController::class, 'update']);
    Route::delete('/admins/{id}', [FuncionarioController::class, 'destroy']);

    // Produtos
    Route::post('/produtos', [ProdutoController::class, 'store']);
    Route::put('/produtos/{id}', [ProdutoController::class, 'update']);
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy']);
});
