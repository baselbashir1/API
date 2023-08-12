<?php

use App\Http\Controllers\API\TechnicalController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/profile', [UserController::class, 'getProfile'])->middleware(['auth:api-user', 'scopes:user']);
Route::get('/user/logout', [UserController::class, 'logout'])->middleware(['auth:api-user', 'scopes:user']);

Route::post('/technical/login', [TechnicalController::class, 'login']);
Route::get('/technical/profile', [TechnicalController::class, 'getProfile'])->middleware(['auth:api-technical', 'scopes:technical']);
Route::get('/technical/logout', [TechnicalController::class, 'logout'])->middleware(['auth:api-technical', 'scopes:technical']);
