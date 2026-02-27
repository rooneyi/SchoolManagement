<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Schools\SchoolController;

/*
*
* @author Rooneyi <22ki129@esisalama.org>
*/

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::apiResource('schools', SchoolController::class);
});
