<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController\AuthController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Guardians\GuardianController;
use App\Http\Controllers\Registrations\RegistrationController;
use App\Http\Controllers\Schools\SchoolController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Years\YearController;
use Illuminate\Support\Facades\Route;

/*
*
* @author Rooneyi <22ki129@esisalama.org>
*/

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::post('auth', AuthController::class);
    Route::post('register', RegisterController::class);
});
Route::middleware('auth:sanctum')->prefix('v1')->name('api.v1.')->group(function () {
    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('sections', SectionController::class);
    Route::apiResource('classrooms', ClassroomController::class);
    Route::apiResource('guardians', GuardianController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('years', YearController::class);
    Route::put('years/{id}/activate', [YearController::class, 'activate']);

    Route::apiResource('registrations', RegistrationController::class);
    Route::post('logout', [AuthController::class, 'logout']);

    // Get update telegram
    Route::get('getupdates', function () {
        try {
            $updates = Telegram::getUpdates();
            return response()->json([
                'success' => true,
                'message' => 'Mises à jour Telegram récupérées avec succès.',
                'data' => $updates,
            ], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des mises à jour Telegram.',
                'error' => $e->getMessage(),
            ], \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    });
});
