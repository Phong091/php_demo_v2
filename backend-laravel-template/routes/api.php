<?php

use App\Containers\Auth\Http\Controllers\Api\LoginController;
use App\Containers\User\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ApiDocsController;
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

Route::get('/docs', [ApiDocsController::class, 'index']);
Route::get('/docs/swagger', [ApiDocsController::class, 'getData']);

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::resource('users', UserController::class, ['only' => ['index', 'store', 'show', 'destroy', 'update']]);
    });
});
