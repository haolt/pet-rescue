<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PostController;

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
        Route::put('profile', [AuthController::class, 'update']);

        Route::post('pets', [PetController::class, 'create']);
        Route::get('pets', [PetController::class, 'showAll']);
        Route::get('pets/{id}', [PetController::class, 'showDetail']);
        Route::put('pets/{id}', [PetController::class, 'update']);
        Route::delete('pets/{id}', [PetController::class, 'delete']);

        Route::post('posts', [PostController::class, 'create']);
        Route::get('posts', [PostController::class, 'showAll']);
        Route::get('posts/{id}', [PostController::class, 'showDetail']);
        Route::put('posts/{id}', [PostController::class, 'update']);
        Route::delete('posts/{id}', [PostController::class, 'delete']);
    });
});
