<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController\UserWebController;
use App\Http\Controllers\Classrooms\ClassroomWebController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Fees\FeeWebController;
use App\Http\Controllers\Guardians\GuardianWebController;
use App\Http\Controllers\Payments\PaymentWebController;
use App\Http\Controllers\Registrations\RegistrationWebController;
use App\Http\Controllers\Schools\SchoolWebController;
use App\Http\Controllers\Sections\SectionWebController;
use App\Http\Controllers\Students\StudentWebController;
use App\Http\Controllers\Years\YearWebController;
use App\Http\Controllers\Employees\EmployeeWebController;
use App\Http\Controllers\Subjects\SubjectWebController;
use App\Http\Controllers\Teachings\TeachingWebController;
use App\Http\Controllers\Schedules\CourseScheduleWebController;
use App\Http\Controllers\OrganigramWebController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('user')->name('users.')->group(function () {
    Route::get('/create', [UserWebController::class, 'create'])->name('create');
    Route::post('/', [UserWebController::class, 'store'])->name('store');
});

Route::middleware(['auth', 'verified'])->prefix('registration')->name('registrations.')->group(function () {
    Route::get('/', [RegistrationWebController::class, 'index'])->name('index');
    Route::get('/create', [RegistrationWebController::class, 'create'])->name('create');
    Route::post('/', [RegistrationWebController::class, 'store'])->name('store');
    Route::get('/{registration}/edit', [RegistrationWebController::class, 'edit'])->name('edit');
    Route::put('/{registration}', [RegistrationWebController::class, 'update'])->name('update');
    Route::put('/{registration}/status', [RegistrationWebController::class, 'changeStatus'])->name('status');
    Route::delete('/{registration}', [RegistrationWebController::class, 'destroy'])->name('destroy');
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

Route::middleware(['auth', 'verified'])->prefix('fee')->name('fees.')->group(function () {
    Route::get('/', [FeeWebController::class, 'index'])->name('index');
    Route::get('/create', [FeeWebController::class, 'create'])->name('create');
    Route::post('/', [FeeWebController::class, 'store'])->name('store');
    Route::get('/{fee}/edit', [FeeWebController::class, 'edit'])->name('edit');
    Route::put('/{fee}', [FeeWebController::class, 'update'])->name('update');
    Route::get('/{fee}', [FeeWebController::class, 'show'])->name('show');
    Route::delete('/{fee}', [FeeWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->name('payments.')->group(function () {
    Route::post('/fees/{fee}/payments', [PaymentWebController::class, 'store'])->name('store');
    Route::delete('/payments/{payment}', [PaymentWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->prefix('employee')->name('employees.')->group(function () {
    Route::get('/', [EmployeeWebController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeWebController::class, 'create'])->name('create');
    Route::post('/', [EmployeeWebController::class, 'store'])->name('store');
    Route::get('/{employee}/edit', [EmployeeWebController::class, 'edit'])->name('edit');
    Route::put('/{employee}', [EmployeeWebController::class, 'update'])->name('update');
    Route::delete('/{employee}', [EmployeeWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->prefix('subject')->name('subjects.')->group(function () {
    Route::get('/', [SubjectWebController::class, 'index'])->name('index');
    Route::get('/create', [SubjectWebController::class, 'create'])->name('create');
    Route::post('/', [SubjectWebController::class, 'store'])->name('store');
    Route::get('/{subject}/edit', [SubjectWebController::class, 'edit'])->name('edit');
    Route::put('/{subject}', [SubjectWebController::class, 'update'])->name('update');
    Route::delete('/{subject}', [SubjectWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->prefix('teaching')->name('teachings.')->group(function () {
    Route::get('/', [TeachingWebController::class, 'index'])->name('index');
    Route::get('/create', [TeachingWebController::class, 'create'])->name('create');
    Route::post('/', [TeachingWebController::class, 'store'])->name('store');
    Route::delete('/{teaching}', [TeachingWebController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->prefix('schedule')->name('schedules.')->group(function () {
    Route::get('/', [CourseScheduleWebController::class, 'index'])->name('index');
    Route::get('/create', [CourseScheduleWebController::class, 'create'])->name('create');
    Route::post('/', [CourseScheduleWebController::class, 'store'])->name('store');
    Route::delete('/{schedule}', [CourseScheduleWebController::class, 'destroy'])->name('destroy');
});



Route::middleware(['auth', 'verified'])->get('/organigram/{school}', [OrganigramWebController::class, 'show'])->name('organigram.index');
require __DIR__.'/settings.php';
