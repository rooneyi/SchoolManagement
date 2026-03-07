<?php

use App\Http\Controllers\ClassroomWebController;
use App\Http\Controllers\GuardianWebController;
use App\Http\Controllers\SchoolWebController;
use App\Http\Controllers\SectionWebController;
use App\Http\Controllers\StudentWebController;
use App\Http\Controllers\YearWebController;
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

Route::middleware(['auth', 'verified'])->prefix('guardian')->name('guardians.')->group(function () {
    Route::get('/', [GuardianWebController::class, 'index'])->name('index');
    Route::get('/create', [GuardianWebController::class, 'create'])->name('create');
    Route::post('/', [GuardianWebController::class, 'store'])->name('store');
    Route::get('/{guardian}/edit', [GuardianWebController::class, 'edit'])->name('edit');
    Route::put('/{guardian}', [GuardianWebController::class, 'update'])->name('update');
    Route::delete('/{guardian}', [GuardianWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->prefix('section')->name('sections.')->group(function () {
    Route::get('/', [SectionWebController::class, 'index'])->name('index');
    Route::get('/create', [SectionWebController::class, 'create'])->name('create');
    Route::post('/', [SectionWebController::class, 'store'])->name('store');
    Route::get('/{section}/edit', [SectionWebController::class, 'edit'])->name('edit');
    Route::put('/{section}', [SectionWebController::class, 'update'])->name('update');
    Route::delete('/{section}', [SectionWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->prefix('classroom')->name('classrooms.')->group(function () {
    Route::get('/', [ClassroomWebController::class, 'index'])->name('index');
    Route::get('/create', [ClassroomWebController::class, 'create'])->name('create');
    Route::post('/', [ClassroomWebController::class, 'store'])->name('store');
    Route::get('/{classroom}/edit', [ClassroomWebController::class, 'edit'])->name('edit');
    Route::put('/{classroom}', [ClassroomWebController::class, 'update'])->name('update');
    Route::delete('/{classroom}', [ClassroomWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->prefix('student')->name('students.')->group(function () {
    Route::get('/', [StudentWebController::class, 'index'])->name('index');
    Route::get('/create', [StudentWebController::class, 'create'])->name('create');
    Route::post('/', [StudentWebController::class, 'store'])->name('store');
    Route::get('/{student}/edit', [StudentWebController::class, 'edit'])->name('edit');
    Route::put('/{student}', [StudentWebController::class, 'update'])->name('update');
    Route::delete('/{student}', [StudentWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->prefix('year')->name('years.')->group(function () {
    Route::get('/', [YearWebController::class, 'index'])->name('index');
    Route::get('/create', [YearWebController::class, 'create'])->name('create');
    Route::post('/', [YearWebController::class, 'store'])->name('store');
    Route::get('/{year}/edit', [YearWebController::class, 'edit'])->name('edit');
    Route::put('/{year}', [YearWebController::class, 'update'])->name('update');
    Route::put('/{year}/activate', [YearWebController::class, 'activate'])->name('activate');
    Route::delete('/{year}', [YearWebController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/settings.php';
