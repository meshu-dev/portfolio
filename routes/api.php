<?php

use App\Http\Controllers\{
    AuthController,
    ContactController,
    PortfolioController,
};
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cv', [App\Http\Controllers\CvController::class, 'get'])->name('cv');

    Route::prefix('portfolio')->group(function () {
        Route::get('/intro', [PortfolioController::class, 'getIntro'])->name('portfolio.intro');
        Route::get('/about', [PortfolioController::class, 'getAbout'])->name('portfolio.about');
        Route::get('/projects', [PortfolioController::class, 'getProjects'])->name('portfolio.projects');
    });
});

Route::post('/contact', [ContactController::class, 'sendMessage'])->name('contact');
