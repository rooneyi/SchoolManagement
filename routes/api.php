<?php

declare(strict_types=1);

use App\Http\Classrooms\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Http\Schools\SchoolController;
use App\Http\Sections\SectionController;
use Telegram\Bot\Laravel\Facades\Telegram;
/*
*
* @author Rooneyi <22ki129@esisalama.org>
*/

Route::middleware('auth:sanctum')->prefix('v1')->name('api.v1.')->group(function () {
    Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
    });
    Route::apiResource('schools', SchoolController::class);
    Route::get('getupdates', function () {
        $updates =  Telegram::getUpdates();
        return response()->json([
            'success' => true,
            'message' => 'Updates Telegram récupérés avec succès',
            'data' => $updates
        ], 200);
    });
    Route::apiResource('sections', SectionController::class);
    Route::apiResource('classrooms', ClassroomController::class);
    Route::apiResource('auth', AuthController::class);
});
