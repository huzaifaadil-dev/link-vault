<?php

use App\Http\Controllers\BookmarksController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->prefix('bookmarks')->as('bookmarks.')->group(function () {
    Route::get('/', [BookmarksController::class, 'index'])->name('index');
});

require __DIR__.'/settings.php';
