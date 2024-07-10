<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cv', [App\Http\Controllers\CvController::class, 'get']);
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'get']);
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'sendMessage']);
