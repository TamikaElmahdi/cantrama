<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

// Frontend pages (Inertia)
Route::get('/', [PageController::class, 'home'])->name('home');
// Breeze redirects here after login
Route::get('/dashboard', fn() => redirect()->route('home'))->middleware(['auth'])->name('dashboard');
Route::get('/contrat/{slug}', [PageController::class, 'contractBuilder'])->name('contract.builder');
Route::get('/mes-contrats', [PageController::class, 'history'])->middleware(['auth'])->name('contracts.history');

// API — templates (public)
Route::prefix('api')->group(function () {
    Route::get('/templates', [TemplateController::class, 'index'])->name('api.templates.index');
    Route::get('/templates/{slug}', [TemplateController::class, 'show'])->name('api.templates.show');

    // Contract — preview (public, no auth required)
    Route::post('/contracts/preview', [ContractController::class, 'preview'])->name('contracts.preview');

    // Contract — download (requires auth + credits)
    Route::post('/contracts/download', [ContractController::class, 'download'])
        ->middleware(['auth', 'contract.access'])
        ->name('contracts.download');

    // Contract — history (auth required)
    Route::get('/contracts/history', [ContractController::class, 'history'])
        ->middleware(['auth'])
        ->name('contracts.history.api');

    // Download a saved PDF by contract id
    Route::get('/contracts/{id}/pdf', [PaymentController::class, 'downloadById'])
        ->name('contracts.download-by-id');

    // Payment
    Route::post('/payment/initiate', [PaymentController::class, 'initiate'])
        ->middleware(['auth'])
        ->name('payment.initiate');
    Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
});

// Admin panel
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/templates', [AdminController::class, 'templates'])->name('templates');
    Route::get('/templates/create', [AdminController::class, 'templateCreate'])->name('templates.create');
    Route::post('/templates', [AdminController::class, 'templateStore'])->name('templates.store');
    Route::get('/templates/{template}/edit', [AdminController::class, 'templateEdit'])->name('templates.edit');
    Route::put('/templates/{template}', [AdminController::class, 'templateUpdate'])->name('templates.update');
    Route::patch('/templates/{template}/toggle', [AdminController::class, 'templateToggle'])->name('templates.toggle');
    Route::get('/contracts', [AdminController::class, 'contracts'])->name('contracts');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}', [AdminController::class, 'userUpdate'])->name('users.update');
});

// Auth + profile routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
