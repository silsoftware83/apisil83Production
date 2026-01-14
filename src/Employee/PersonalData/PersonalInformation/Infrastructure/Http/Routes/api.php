<?php

use Illuminate\Support\Facades\Route;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Http\Controllers\PersonalDataController;

Route::prefix('employee/personaldata')->group(function () {
    Route::get('/', [PersonalDataController::class, 'index']);
    Route::get('/search', [PersonalDataController::class, 'search']);
    Route::get('/getImmeditedBossAndDepartments', [PersonalDataController::class, 'getImmeditedBossAndDepartments']);

    Route::post('/', [PersonalDataController::class, 'store']);
    Route::get('/{id}', [PersonalDataController::class, 'findById']);

    Route::put('/{id}', [PersonalDataController::class, 'update']);
    Route::put('/desactivate/{id}', [PersonalDataController::class, 'desactivate']);
    Route::delete('/{id}', [PersonalDataController::class, 'destroy']);
});
