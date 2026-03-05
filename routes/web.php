<?php

use App\Http\Controllers\{
    AuthController,
    TechnologyController,
};
use App\Http\Controllers\Cv\{ProfileController, SkillController, WorkExperienceController};
use App\Http\Controllers\Portfolio\{AboutController, IntroController, ProjectController, RepositoryController};
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin']);
Route::post('/login/demo', [AuthController::class, 'demoLogin']);

Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [ProfileController::class, 'view'])->name('profile.view'); 

    Route::prefix('cv')->group(function () {       
        //Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view'); 
        Route::put('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

        Route::prefix('skills')->group(function () {
            Route::get('/', [SkillController::class, 'view'])->name('skills.view');
            Route::put('/', [SkillController::class, 'edit'])->name('skills.edit');
        });

        Route::prefix('work-experiences')->group(function () {
            Route::get('/', [WorkExperienceController::class, 'list'])->name('work-experiences.list');
            Route::get('/new', [WorkExperienceController::class, 'new'])->name('work-experiences.new');
            Route::get('/{id}', [WorkExperienceController::class, 'view'])->name('work-experiences.view');
            Route::post('/', [WorkExperienceController::class, 'add'])->name('work-experiences.add');
            Route::put('/{id}', [WorkExperienceController::class, 'edit'])->name('work-experiences.edit');
            Route::delete('/{id}', [WorkExperienceController::class, 'delete'])->name('work-experiences.delete');
        });
    });

    Route::prefix('portfolio')->group(function () {
        Route::prefix('intro')->group(function () {
            Route::get('/', [IntroController::class, 'view'])->name('intro.view');
            Route::put('/', [IntroController::class, 'edit'])->name('intro.edit');
        });

        Route::prefix('about')->group(function () {
            Route::get('/', [AboutController::class, 'view'])->name('about.view');
            Route::put('/', [AboutController::class, 'edit'])->name('about.edit');
        });

        Route::prefix('repositories')->group(function () {
            Route::get('/',        [RepositoryController::class, 'list'])->name('repositories.list');
            Route::post('/',       [RepositoryController::class, 'add'])->name('repositories.add');
            Route::delete('/{id}', [RepositoryController::class, 'delete'])->name('repositories.delete');
        });

        Route::prefix('projects')->group(function () {
            Route::get('/',     [ProjectController::class, 'list'])->name('projects.list');
            Route::get('/{id}', [ProjectController::class, 'view'])->name('projects.view');
            //Route::put('/', [SkillController::class, 'edit'])->name('skills.edit');
        });
    });

    Route::prefix('technologies')->group(function () {
        Route::get('/', [TechnologyController::class, 'view'])->name('technologies.view');
        Route::post('/', [TechnologyController::class, 'add'])->name('technologies.add');
        Route::delete('/{id}', [TechnologyController::class, 'delete'])->name('technologies.delete');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
