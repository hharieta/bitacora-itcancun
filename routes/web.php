<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/articles', App\Livewire\Articles\ManageArticles::class)->name('articles');
    Route::get('/requisitions/create', App\Livewire\Requisitions\CreateRequisition::class)->name('requisitions.create');
});
require __DIR__.'/auth.php';
