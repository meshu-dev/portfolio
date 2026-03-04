<?php

use App\Http\Controllers\{
    AuthController,
    ProfileController,
    SkillController,
    TechnologyController,
    WorkExperienceController
};
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin']);
Route::post('/login/demo', [AuthController::class, 'demoLogin']);

Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [ProfileController::class, 'view'])->name('profile.view');
    Route::put('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::prefix('skills')->group(function () {
        Route::get('/', [SkillController::class, 'view'])->name('skills.view');
        Route::put('/', [SkillController::class, 'edit'])->name('skills.edit');
    });

    Route::prefix('technologies')->group(function () {
        Route::get('/', [TechnologyController::class, 'view'])->name('technologies.view');
        Route::post('/', [TechnologyController::class, 'add'])->name('technologies.add');
        Route::delete('/{id}', [TechnologyController::class, 'delete'])->name('technologies.delete');
    });

    Route::prefix('work-experiences')->group(function () {
        Route::get('/', [WorkExperienceController::class, 'list'])->name('work-experiences.list');
        Route::get('/new', [WorkExperienceController::class, 'new'])->name('work-experiences.new');
        Route::get('/{id}', [WorkExperienceController::class, 'view'])->name('work-experiences.view');
        Route::post('/', [WorkExperienceController::class, 'add'])->name('work-experiences.add');
        Route::put('/{id}', [WorkExperienceController::class, 'edit'])->name('work-experiences.edit');
        Route::delete('/{id}', [WorkExperienceController::class, 'delete'])->name('work-experiences.delete');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
