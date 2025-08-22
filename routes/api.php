<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\PostController;

// Public routes
Route::post('register', [RegisteredUserController::class, 'storeApi']);
Route::post('login', [AuthenticatedSessionController::class, 'apiLogin']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('admin/posts', [PostController::class, 'indexApi']);
    Route::get('admin/posts/{id}', [PostController::class, 'showApi']);
    Route::post('admin/posts', [PostController::class, 'storeApi']);
    Route::put('admin/posts/{id}', [PostController::class, 'updateApi']);
    Route::delete('admin/posts/{id}', [PostController::class, 'destroyApi']);

    Route::get('user/profile', [AuthenticatedSessionController::class, 'profile']);
    Route::post('logout', [AuthenticatedSessionController::class, 'apiLogout']);
});

