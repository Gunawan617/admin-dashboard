<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Homepage
// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Dashboard user
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin/analytics', [AnalyticsController::class, 'dashboard'])->name('admin.analytics');




Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AnalyticsController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('posts', PostController::class)->names('admin.posts');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)
        ->except(['create', 'store', 'destroy', 'show'])
        ->names('admin.users');
    Route::resource('books', App\Http\Controllers\Admin\BookController::class)
        ->names('admin.books');
});


// Route::get('/', function () {
//     return view('admin.dashboard');
// })->name('dashboard');

// Admin routes
// Route::middleware(['auth'])->prefix('admin')->group(function () {
//     Route::get('/', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');

//     Route::resource('posts', PostController::class);
// });

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

// Optional home route
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
