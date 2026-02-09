<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::livewire('/admin/cv', 'pages::admin.cv')->name('admin.cv');
});

Route::livewire('/admin/login', 'pages::admin.login');

Route::livewire('/post/create', 'pages::post.create');
