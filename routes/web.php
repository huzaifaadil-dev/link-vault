<?php

use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->prefix('bookmarks')->as('bookmarks.')->group(function () {
    Route::get('/', [BookmarksController::class, 'index'])->name('index');
    Route::post('/', [BookmarksController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->prefix('categories')->as('categories.')->group(function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('index');
    Route::post('/', [CategoriesController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->prefix('tags')->as('tags.')->group(function () {
    Route::get('/', [TagsController::class, 'index'])->name('index');
    Route::post('/', [TagsController::class, 'store'])->name('store');
});

require __DIR__.'/settings.php';
