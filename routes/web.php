<?php

use App\Http\Controllers\FoodPostController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('food-posts.index');
});

// Auth routes (dari Breeze)
require __DIR__.'/auth.php';

// Routes yang butuh login
Route::middleware('auth')->group(function () {

    // Profile (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Food Posts
    Route::get('/makanan', [FoodPostController::class, 'index'])->name('food-posts.index');
    Route::get('/makanan/tambah', [FoodPostController::class, 'create'])->name('food-posts.create');
    Route::post('/makanan', [FoodPostController::class, 'store'])->name('food-posts.store');
    Route::delete('/makanan/{foodPost}', [FoodPostController::class, 'destroy'])->name('food-posts.destroy');
    Route::get('/makanan/{foodPost}/edit', [FoodPostController::class, 'edit'])->name('food-posts.edit');
    Route::patch('/makanan/{foodPost}', [FoodPostController::class, 'update'])->name('food-posts.update');

    // Claims
    Route::post('/makanan/{foodPost}/klaim', [ClaimController::class, 'store'])->name('claims.store');
    Route::get('/klaim-saya', [ClaimController::class, 'myClaims'])->name('claims.my');
    Route::patch('/klaim/{claim}/confirm', [ClaimController::class, 'confirm'])->name('claims.confirm');
    Route::get('/klaim-masuk', [ClaimController::class, 'kantinClaims'])->name('claims.kantin');
});