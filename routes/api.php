<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cv', [App\Http\Controllers\CvController::class, 'get'])->name('cv');

Route::prefix('portfolio')->group(function () {
    Route::get('/intro', [App\Http\Controllers\PortfolioController::class, 'getIntro'])->name('portfolio.intro');
    Route::get('/about', [App\Http\Controllers\PortfolioController::class, 'getAbout'])->name('portfolio.about');
    Route::get('/projects', [App\Http\Controllers\PortfolioController::class, 'getProjects'])->name('portfolio.projects');
});

Route::prefix('github')->group(function () {
    Route::get('/streak-stats', [App\Http\Controllers\GitHubController::class, 'getStreakStats'])->name('github.streak-stats');
    Route::get('/tech-stats', [App\Http\Controllers\GitHubController::class, 'getTechStats'])->name('github.tech-stats');
});

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'sendMessage'])->name('contact');
