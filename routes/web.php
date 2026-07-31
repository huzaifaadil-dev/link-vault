<?php

use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->prefix('bookmarks')->as('bookmarks.')->group(function () {
    Route::get('/', [BookmarksController::class, 'index'])->name('index');
});

Route::middleware(['auth'])->prefix('categories')->as('categories.')->group(function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('index');
});

require __DIR__.'/settings.php';
