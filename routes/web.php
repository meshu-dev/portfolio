<?php

use App\Http\Controllers\Admin\{
    AuthController,
    SiteController,
    TechnologyController,
};
use App\Http\Controllers\Admin\Cv\{
    ProfileController,
    SkillController,
    WorkExperienceController,
};
use App\Http\Controllers\Admin\Portfolio\{
    AboutController,
    IntroController,
    ProjectController,
    RepositoryController,
};
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin']);
Route::post('/login/demo', [AuthController::class, 'demoLogin']);

Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [ProfileController::class, 'view'])->name('profile.view'); 

    Route::prefix('cv')->group(function () {
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
            Route::get('/',        [ProjectController::class, 'list'])->name('projects.list');
            Route::get('/new',     [ProjectController::class, 'new'])->name('projects.new');
            Route::get('/{id}',    [ProjectController::class, 'view'])->name('projects.view');
            Route::post('/',       [ProjectController::class, 'add'])->name('projects.add');
            Route::put('/{id}',    [ProjectController::class, 'edit'])->name('projects.edit');
            Route::delete('/{id}', [ProjectController::class, 'delete'])->name('projects.delete');
        });
    });

    Route::prefix('technologies')->group(function () {
        Route::get('/', [TechnologyController::class, 'view'])->name('technologies.view');
        Route::post('/', [TechnologyController::class, 'add'])->name('technologies.add');
        Route::delete('/{id}', [TechnologyController::class, 'delete'])->name('technologies.delete');
    });

    Route::prefix('sites')->group(function () {
        Route::get('/', [SiteController::class, 'list'])->name('sites.list');
        Route::get('/new', [SiteController::class, 'new'])->name('sites.new');
        Route::get('/{id}', [SiteController::class, 'view'])->name('sites.view');
        Route::post('/', [SiteController::class, 'add'])->name('sites.add');
        Route::put('/{id}', [SiteController::class, 'edit'])->name('sites.edit');
        Route::delete('/{id}', [SiteController::class, 'delete'])->name('sites.delete');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
