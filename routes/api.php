<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ColeccionController;
use App\Http\Controllers\Api\IntercambioController;

Route::middleware('auth:sanctum')->group(function () {

    //Coleccion propia
    Route::get('/coleccion', [ColeccionController::class, 'index']);
    Route::post('/coleccion', [ColeccionController::class, 'store']);
    Route::put('/coleccion/{id}', [ColeccionController::class, 'update']);
    Route::delete('/coleccion/{id}', [ColeccionController::class, 'destroy']);

    //QR
    Route::get('/mi-qr', [ColeccionController::class, 'miQr']);

    //Intercambio
    Route::get('/intercambio/{qr_token}', [IntercambioController::class, 'show']);
});

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);