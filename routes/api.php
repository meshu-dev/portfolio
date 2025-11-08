<?php

use App\Http\Controllers\{
    AuthController,
    ContactController,
    GitHubController,
    PortfolioController,
};
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cv', [App\Http\Controllers\CvController::class, 'get'])->name('cv');

    Route::prefix('portfolio')->group(function () {
        Route::get('/intro', [PortfolioController::class, 'getIntro'])->name('portfolio.intro');
        Route::get('/about', [PortfolioController::class, 'getAbout'])->name('portfolio.about');
        Route::get('/projects', [PortfolioController::class, 'getProjects'])->name('portfolio.projects');
    });

    Route::prefix('github')->group(function () {
        Route::get('/streak-stats', [GitHubController::class, 'getStreakStats'])->name('github.streak-stats');
        Route::get('/tech-stats', [GitHubController::class, 'getTechStats'])->name('github.tech-stats');
    });
});

Route::post('/contact', [ContactController::class, 'sendMessage'])->name('contact');
