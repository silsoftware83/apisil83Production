<?php

use Illuminate\Support\Facades\Route;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Http\Controllers\DepartmentsAndPositionsController;

Route::prefix('configuration/company/departmentsandpositions')->group(function () {
    Route::get('/', [DepartmentsAndPositionsController::class, 'index']);
    Route::post('/', [DepartmentsAndPositionsController::class, 'store']);
    Route::post('/positions', [DepartmentsAndPositionsController::class, 'storePositions']);
    Route::put('/positions/{id}', [DepartmentsAndPositionsController::class, 'updatePosition']);
    Route::delete('/positions/{id}', [DepartmentsAndPositionsController::class, 'destroyPosition']);
    Route::get('/{id}', [DepartmentsAndPositionsController::class, 'show']);
    Route::put('/{id}', [DepartmentsAndPositionsController::class, 'update']);
    Route::delete('/{id}', [DepartmentsAndPositionsController::class, 'destroy']);
});
