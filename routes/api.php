<?php

use App\Http\Controllers\Auth\FuncionarioAuthController;
use App\Http\Controllers\Auth\ClienteAuthController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::post('/clientes/login', [ClienteAuthController::class, 'login']);
Route::post('/admins/login', [FuncionarioAuthController::class, 'login']);

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/clientes/logout', [ClienteAuthController::class, 'logout']);
    Route::post('/admins/logout', [FuncionarioAuthController::class, 'logout']);

    // Clientes
    Route::get('/clientes', [ClienteAuthController::class, 'index']);
    Route::get('/clientes/{id}', [ClienteAuthController::class, 'show']);
    Route::post('/clientes', [ClienteAuthController::class, 'store']);
    Route::put('/clientes/{id}', [ClienteAuthController::class, 'update']);
    Route::delete('/clientes/{id}', [ClienteAuthController::class, 'destroy']);

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
