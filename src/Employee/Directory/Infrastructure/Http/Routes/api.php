<?php

use Illuminate\Support\Facades\Route;
use Src\Employee\Directory\Infrastructure\Http\Controllers\DirectoryController;

Route::prefix('employee/directory')->group(function () {
    Route::get('/', [DirectoryController::class, 'index']);
    Route::post('/', [DirectoryController::class, 'store']);
    Route::get('/{id}', [DirectoryController::class, 'show']);
    Route::put('/{id}', [DirectoryController::class, 'update']);
    Route::delete('/{id}', [DirectoryController::class, 'destroy']);
});
