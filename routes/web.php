<?php

use App\Http\Controllers\SchoolWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

use App\Http\Controllers\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

use App\Http\Controllers\UserWebController;

Route::middleware(['auth', 'verified'])->prefix('user')->name('users.')->group(function () {
    Route::get('/create', [UserWebController::class, 'create'])->name('create');
    Route::post('/', [UserWebController::class, 'store'])->name('store');
});

Route::middleware(['auth', 'verified'])->prefix('school')->name('schools.')->group(function () {
    Route::get('/', [SchoolWebController::class, 'index'])->name('index');
    Route::get('/create', [SchoolWebController::class, 'create'])->name('create');
    Route::post('/', [SchoolWebController::class, 'store'])->name('store');
    Route::get('/{school}/edit', [SchoolWebController::class, 'edit'])->name('edit');
    Route::put('/{school}', [SchoolWebController::class, 'update'])->name('update');
    Route::delete('/{school}', [SchoolWebController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/settings.php';
