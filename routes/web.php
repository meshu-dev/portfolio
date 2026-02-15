<?php

Route::livewire('/login', 'pages::auth.login')->name('login');

Route::middleware(['auth:web'])->group(function () {
    Route::livewire('/',                      'pages::cv.profile');
    Route::livewire('/skills',                'pages::cv.skills');
    Route::livewire('/work-experiences',      'pages::cv.work-experiences');
    Route::livewire('/work-experiences/{id}', 'pages::cv.work-experience');
    Route::livewire('/logout',                'pages::auth.logout');

    Route::livewire('/hello',                      'pages::users.index');
});
