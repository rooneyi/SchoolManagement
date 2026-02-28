<?php

declare(strict_types=1);

use App\Http\Classrooms\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Http\Schools\SchoolController;
use Telegram\Bot\Laravel\Facades\Telegram;
/*
*
* @author Rooneyi <22ki129@esisalama.org>
*/

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::apiResource('schools', SchoolController::class);
    Route::get('getupdates', function () {
        $updates =  Telegram::getUpdates();
        return response()->json([
            'success' => true,
            'message' => 'Updates Telegram récupérés avec succès',
            'data' => $updates
        ], 200);
    });
    Route::apiResource('classrooms', ClassroomController::class);
});
