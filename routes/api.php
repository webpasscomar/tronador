<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiTrailsController;
use App\Http\Controllers\Api\ApiNationalitiesController;
use App\Http\Controllers\Api\ApiReferencesController;
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

// Rutas Senderos
// Route::middleware('auth:sanctum')->group(function () {
Route::get('/trails/v1', [ApiTrailsController::class, 'index'])->middleware('auth:sanctum');
// });

Route::get('/nationalities/v1', [ApiNationalitiesController::class, 'index'])->middleware('auth:sanctum');

Route::get('/references/v1/{topic_id}', [ApiReferencesController::class, 'byTopic'])->middleware('auth:sanctum');
