<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BandaController;
use App\Http\Controllers\API\ConteoBandaController;
use App\Http\Controllers\API\ConteoController;
use App\Http\Controllers\API\FraternidadController;
use App\Http\Controllers\API\ResultadosController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\GestionController;
use Illuminate\Support\Facades\Request;



Route::prefix('/v1/auth')->group(function () {
    // Rutas de autenticación (Login)
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset']);

    // Rutas protegidas de autenticación
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('/v1')->group(function () {
    // Rutas protegidas con autenticación Sanctum
    Route::middleware(['auth:sanctum'])->group(function () {
        // Los usuarios autenticados pueden acceder a estas rutas
        Route::apiResource('/fraternidades', FraternidadController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
        //Route::apiResource('/bandas', BandaController::class);
        Route::apiResource('/conteos', ConteoController::class);
        Route::apiResource('/conteos-bandas', ConteoBandaController::class);
        Route::apiResource('/gestiones', GestionController::class);
        Route::get('/fraternidades/{fraternidadId}/bandas', [ConteoBandaController::class, 'bandasPorFraternidad']);
    });
});

Route::prefix('/v1')->group(function () {
    Route::apiResource('/fraternidades', FraternidadController::class)->only(['index', 'show']);
    Route::apiResource('/bandas', BandaController::class);
    Route::get('/resultados', [ResultadosController::class, 'index']);
});



// Obtener usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


