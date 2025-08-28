<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\TeamMemberController;

use App\Http\Controllers\TryoutProgramController;
use App\Http\Controllers\BimbelProgramController;

Route::apiResource('bimbel-programs', BimbelProgramController::class);



Route::apiResource('tryout-programs', TryoutProgramController::class);


Route::apiResource('team-members', TeamMemberController::class);

Route::get('public/posts', [PostController::class, 'indexApi']);
Route::get('public/posts/{id}', [PostController::class, 'showApi']);
Route::post('public/posts', [PostController::class, 'storeApi']);
Route::put('public/posts/{id}', [PostController::class, 'updateApi']);
Route::delete('public/posts/{id}', [PostController::class, 'destroyApi']);


Route::post('/track', [AnalyticsController::class, 'store']);
Route::get('/analytics', function() {
    return \App\Models\Visit::orderBy('id', 'desc')->limit(10)->get();
});


// Public routes
Route::post('register', [RegisteredUserController::class, 'storeApi']);
Route::post('login', [AuthenticatedSessionController::class, 'apiLogin']);

// Public Books API (untuk testing)
Route::get('public/books', [App\Http\Controllers\Admin\BookController::class, 'indexApi']);
Route::get('public/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'showApi']);
Route::post('public/books', [App\Http\Controllers\Admin\BookController::class, 'storeApi']);
Route::put('public/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'updateApi']);
Route::delete('public/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'destroyApi']);

// Analytics API (untuk tracking visits dari Next.js)
Route::post('analytics/track', [App\Http\Controllers\AnalyticsController::class, 'store']);
Route::get('analytics/dashboard', [App\Http\Controllers\AnalyticsController::class, 'dashboard']);
Route::get('analytics/visits', [App\Http\Controllers\AnalyticsController::class, 'getVisits']);
Route::get('analytics/stats', [App\Http\Controllers\AnalyticsController::class, 'getStats']);

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

