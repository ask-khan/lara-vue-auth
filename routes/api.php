<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('user',  [App\Http\Controllers\AuthController::class, 'user']);
        Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    });

    Route::group(['middleware' => 'jwt.refresh'], function () {
        Route::get('refresh',  [App\Http\Controllers\AuthController::class, 'refresh']);
    });
});

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::resource('user', 'UsersController');
});
