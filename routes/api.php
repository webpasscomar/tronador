<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiTrailsController;
use App\Http\Controllers\Api\ApiNationalitiesController;
use App\Http\Controllers\Api\ApiReferencesController;
use App\Http\Controllers\Api\ApiUsersController;
use App\Http\Controllers\Api\ApiPointsController;
use App\Http\Controllers\Api\ApiAlertsController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
    */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Ruta para el login del usuario
Route::post('/login', [ApiAuthController::class, 'login']);

// Ruta para crear un nuevo usuario
Route::post('/users/v1', [ApiUsersController::class, 'store']);

// Rutas protegidas por auth:sanctum , se acceden con el token generado al loguearse

Route::middleware('auth:sanctum')->group(function () {
    // Ruta para obtener el usuario por email con el detalle del mismo
    Route::get('/users/v1/{email}', [ApiUsersController::class, 'byUser']);
    // Rutas Senderos
    Route::get('/trails/v1', [ApiTrailsController::class, 'index']);

    // Rutas Natiocionalidades
    Route::get('/nationalities/v1', [ApiNationalitiesController::class, 'index']);

    // Rutas Referencias
    Route::get('/references/v1', 
    [ApiReferencesController::class, 'index']);

    Route::get('/references/v1/topic/{topic_id}', [ApiReferencesController::class, 'byTopic']);

    Route::get('/references/v1/trail/{trail_id}', [ApiReferencesController::class, 'byTrail']);
    
    // Rutas puntos
    Route::get('/points/v1/{trail_id}', [ApiPointsController::class, 'byTrail']);

    // Rutas alertas
    Route::get('/alerts/v1', [ApiAlertsController::class, 'index']);
});