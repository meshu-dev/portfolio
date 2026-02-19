<?php

use App\Http\Controllers\{
    AuthController,
    ProfileController,
    SkillController,
    TechnologyController,
    WorkExperienceController
};
use Illuminate\Support\Facades\Route;

Route::get('/login',       [AuthController::class, 'index'])->name('login');
Route::post('/login',      [AuthController::class, 'userLogin']);
Route::post('/login/demo', [AuthController::class, 'demoLogin']);

Route::middleware(['auth:web'])->group(function () {
    Route::get('/',                      [ProfileController::class, 'view'])->name('admin.index');
    Route::get('/skills',                [SkillController::class, 'view']);
    Route::get('/technologies',          [TechnologyController::class, 'view']);
    Route::get('/work-experiences',      [WorkExperienceController::class, 'view']);
    Route::get('/work-experiences/new',  [WorkExperienceController::class, 'add']);
    Route::get('/work-experiences/{id}', [WorkExperienceController::class, 'get']);
    Route::post('/logout',               [AuthController::class, 'logout']);
});
