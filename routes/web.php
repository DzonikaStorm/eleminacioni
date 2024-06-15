<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('index');
});

Route::resource('posts', PostController::class);

Route::resource('categories', CategoryController::class);

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/posts', AdminPostController::class);
    Route::resource('admin/users', AdminUserController::class);
});


