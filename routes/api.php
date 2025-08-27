<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\PostController;

Route::get('public/posts', [PostController::class, 'indexApi']);
Route::get('public/posts/{id}', [PostController::class, 'showApi']);


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

    // Books CRUD API (pakai method khusus API)
    Route::get('admin/books', [App\Http\Controllers\Admin\BookController::class, 'indexApi']);
    Route::get('admin/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'showApi']);
    Route::post('admin/books', [App\Http\Controllers\Admin\BookController::class, 'storeApi']);
    Route::put('admin/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'updateApi']);
    Route::delete('admin/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'destroyApi']);
});

