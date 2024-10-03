<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cv', [App\Http\Controllers\CvController::class, 'get']);

Route::prefix('portfolio')->group(function () {
    Route::get('/intro', [App\Http\Controllers\PortfolioController::class, 'getIntro']);
    Route::get('/about', [App\Http\Controllers\PortfolioController::class, 'getAbout']);
    Route::get('/projects', [App\Http\Controllers\PortfolioController::class, 'getProjects']);
});

Route::prefix('github')->group(function () {
    Route::get('/streak-stats', [App\Http\Controllers\GitHubController::class, 'getStreakStats']);
    Route::get('/tech-stats', [App\Http\Controllers\GitHubController::class, 'getTechStats']);
});

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'sendMessage']);
