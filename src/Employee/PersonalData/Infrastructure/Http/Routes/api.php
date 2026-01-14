<?php

use Illuminate\Support\Facades\Route;
use Src\Employee\PersonalData\Infrastructure\Http\Controllers\PersonalDataController;

Route::prefix('employee/personaldata')->group(function () {
    Route::get('/', [PersonalDataController::class, 'index']);
    Route::get('/search', [PersonalDataController::class, 'search']);
    Route::get('/getImmeditedBossAndDepartments', [PersonalDataController::class, 'getImmeditedBossAndDepartments']);
    Route::post('/', [PersonalDataController::class, 'store']);
    Route::get('/{id}', [PersonalDataController::class, 'show']);
    Route::put('/{id}', [PersonalDataController::class, 'update']);
    Route::delete('/{id}', [PersonalDataController::class, 'destroy']);
});
