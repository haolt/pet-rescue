<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;

Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'user']);

        Route::post('pets', [PetController::class, 'create']);
        Route::get('pets', [PetController::class, 'showAll']);
        Route::get('pets/{id}', [PetController::class, 'showDetail']);
        Route::put('pets/{id}', [PetController::class, 'update']);
        Route::delete('pets/{id}', [PetController::class, 'delete']);

    });
});
