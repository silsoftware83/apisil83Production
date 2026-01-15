<?php

use Illuminate\Support\Facades\Route;
use Src\TimeAndLocation\Infrastructure\Http\Controllers\TimeAndLocationController;

Route::prefix('locations/registerCheckNew')->group(function () {
    Route::get('/', [TimeAndLocationController::class, 'index']);
    Route::post('/', [TimeAndLocationController::class, 'store']);
    Route::get('/{id}', [TimeAndLocationController::class, 'show']);
    Route::put('/{id}', [TimeAndLocationController::class, 'update']);
    Route::delete('/{id}', [TimeAndLocationController::class, 'destroy']);
});
