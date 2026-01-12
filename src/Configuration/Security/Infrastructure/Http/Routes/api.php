<?php

use Illuminate\Support\Facades\Route;
use Src\Configuration\Security\Infrastructure\Http\Controllers\SecurityController;

Route::prefix('configuration/security')->group(function () {
    Route::get('/', [SecurityController::class, 'index']);
    Route::post('/', [SecurityController::class, 'store']);
    Route::get('/{id}', [SecurityController::class, 'show']);
    Route::put('/{id}', [SecurityController::class, 'update']);
    Route::delete('/{id}', [SecurityController::class, 'destroy']);
});
