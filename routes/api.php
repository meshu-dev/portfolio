<?php

use App\Http\Controllers\Api\{
    AuthController,
    ContactController,
    CvController,
    PortfolioController,
};
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cv', [CvController::class, 'get'])->name('cv');
    Route::get('/portfolio', [PortfolioController::class, 'get'])->name('portfolio');
});

Route::post('/contact', [ContactController::class, 'sendMessage'])->name('contact');
