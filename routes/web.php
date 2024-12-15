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

Route::get('/requisitions', App\Livewire\Requisitions\ListRequisitions::class)
    ->middleware(['auth'])
    ->name('requisitions.index');

Route::get('/articles/list', App\Livewire\Articles\ListArticles::class)
->middleware(['auth'])
->name('articles.list');

Route::get('/requisitions/{requisition}/edit', App\Livewire\Requisitions\EditRequisition::class)
    ->name('requisitions.edit')
    ->middleware(['auth']);

Route::get('/articles/{article}/edit', App\Livewire\Articles\EditArticle::class)
->name('articles.edit')
->middleware(['auth']);

require __DIR__.'/auth.php';
