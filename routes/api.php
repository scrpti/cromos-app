<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ColeccionController;
use App\Http\Controllers\Api\IntercambioController;

Router::middleware('auth:sanctum')->group(function () {

    //Coleccion propia
    Route::get('/coleccion', [ColecionController::class, 'index']);
    Route::post('/coleccion', [ColecionController::class, 'store']);
    Route::put('/coleccion/{id}', [ColecionController::class, 'update']);
    Route::delete('/coleccion/{id}', [ColecionController::class, 'destroy']);

    //QR
    Route::get('/mi-qr', [ColecionController::class, 'miQr']);

    //Intercambio
    Route::get('/intercambio/{qr_token}', [IntercambioController::class, 'show']);
});

Route::post('/registro', [App\Http\Controllers\Api\AuthController::class, 'registro']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);