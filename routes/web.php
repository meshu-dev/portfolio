<?php

Route::livewire('/login', 'pages::auth.login')->name('login');

Route::middleware(['auth:web'])->group(function () {
    Route::livewire('/', 'pages::users.index');
    Route::livewire('/profile', 'pages::cv.profile');
    Route::livewire('/skills', 'pages::cv.skills');
    Route::livewire('/logout', 'pages::auth.logout');
});
