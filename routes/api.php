<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BilletController;
use App\Http\Controllers\Api\V1\SpectacleController;
use App\Http\Controllers\Api\V1\TransactionController;
use App\Http\Controllers\Api\V1\UtilisateurController;

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

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum', 'api_key']], function(){
    Route::apiResource('events', SpectacleController::class);
    Route::apiResource('billet', BilletController::class);
    Route::apiResource('transaction', TransactionController::class);
    Route::apiResource('utilisateur', UtilisateurController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});
