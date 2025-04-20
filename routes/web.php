<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Categorie Routes
    // Show all categories
    Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Show the form to create a new categorie
    Route::get('categories/create', [CategorieController::class, 'create'])->name('categories.create');

    // Store a newly created categorie in the database
    Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');

    // Show the form to edit an existing categorie
    Route::get('categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');

    // Update an existing categorie
    Route::put('categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');

    // Delete a categorie
    Route::delete('categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');
    // Fournisseur Routes
    Route::resource('fournisseurs', FournisseurController::class);

    // Article Routes
    Route::resource('articles', ArticleController::class);

    // Vente Routes
    Route::resource('ventes', VenteController::class);
});

require __DIR__ . '/auth.php';
