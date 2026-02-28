<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController\AuthController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Schools\SchoolController;
use App\Http\Controllers\Sections\SectionController;
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
    Route::post('logout', [AuthController::class, 'logout']);

    // Get update telegram
    //    Route::get('getupdates', function () {
    //        $updates = Telegram::getUpdates();
    //
    //        return response()->json([
    //            'success' => true,
    //            'message' => 'Updates Telegram récupérés avec succès',
    //            'data' => $updates,
    //        ], 200);
    //    });
});
