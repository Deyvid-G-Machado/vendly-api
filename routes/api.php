<?php

use App\Http\Controllers\Auth\FuncionarioAuthController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::post('/funcionarios/login', [FuncionarioAuthController::class, 'login']);

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('produtos', ProdutoController::class);

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/funcionarios/logout', [FuncionarioAuthController::class, 'logout']);
    Route::apiResource('funcionarios', FuncionarioController::class);
});
