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
    Route::get('/', [ProfileController::class, 'view'])->name('admin.index');
    Route::put('/profile', [ProfileController::class, 'edit']);

    Route::prefix('skills')->group(function () {
        Route::get('/', [SkillController::class, 'view']);
        Route::put('/', [SkillController::class, 'edit']);
    });

    Route::prefix('technologies')->group(function () {
        Route::get('/',        [TechnologyController::class, 'view']);
        Route::post('/',       [TechnologyController::class, 'add']);
        Route::delete('/{id}', [TechnologyController::class, 'delete']);
    });

    Route::prefix('work-experiences')->group(function () {
        Route::get('/',        [WorkExperienceController::class, 'list'])->name('work-experiences.list');
        Route::get('/new',     [WorkExperienceController::class, 'new']);
        Route::get('/{id}',    [WorkExperienceController::class, 'view']);
        Route::post('/',   [WorkExperienceController::class, 'add']);
        Route::put('/{id}',    [WorkExperienceController::class, 'edit']);
        Route::delete('/{id}', [WorkExperienceController::class, 'delete']);
    });

    Route::post('/logout',                  [AuthController::class, 'logout']);
});
