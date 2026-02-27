<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('create.student', 'create.student')
    ->middleware(['auth', 'verified'])
    ->name('create.student');
Route::view('create.school', 'create.school')
    ->middleware(['auth', 'verified'])
    ->name('create.school');


require __DIR__.'/settings.php';
