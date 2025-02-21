<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BandaController;
use App\Http\Controllers\API\ConteoController;
use App\Http\Controllers\API\FraternidadController;
use Illuminate\Support\Facades\Request;

// Rutas de autenticación (Login, Registro, Logout)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Obtener usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas protegidas con autenticación Sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    
    // 📌 Usuarios autenticados pueden ver Fraternidades
    Route::apiResource('/fraternidades', FraternidadController::class)->only(['index', 'show']);

    // 📌 Solo los ADMIN pueden modificar datos
    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('/fraternidades', FraternidadController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/bandas', BandaController::class);
        Route::apiResource('/conteos', ConteoController::class);
    });
});
