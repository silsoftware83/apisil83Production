<?php

use Illuminate\Support\Facades\Route;
use Src\Configuration\Security\Infrastructure\Http\Controllers\SecurityController;

Route::prefix('configuration/security')->group(function () {
    Route::get('/', [SecurityController::class, 'index']);
    Route::post('/', [SecurityController::class, 'store']);
    Route::post('/gestionpermissions', [SecurityController::class, 'gestionpermissions']);
    Route::put('/updatepassword', [SecurityController::class, 'showPasswordRestore']);
    Route::get('/password', [SecurityController::class, 'showPassword']);
    Route::get('/getEmployeeWhitOutUser', [SecurityController::class, 'getEmployeeWhitOutUser']);
    Route::post('/adduser', [SecurityController::class, 'addUser']);

    Route::get('/{id}', [SecurityController::class, 'show']);
    Route::put('/{id}', [SecurityController::class, 'update']);
    Route::delete('/{id}', [SecurityController::class, 'destroy']);
});
