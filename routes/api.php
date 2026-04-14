<?php

use App\Http\Controllers\Api\EmployeeController;


Route::post('/employee', [EmployeeController::class, 'store']);
Route::get('/employee', [EmployeeController::class, 'index']);

Route::get('/employee/{id}', [EmployeeController::class, 'show']);
Route::put('/employee/{id}', [EmployeeController::class, 'update']);
Route::delete('/employee/{id}', [EmployeeController::class, 'delete']);

Route::post('/register', [EmployeeController::class, 'register']);
Route::post('/login', [EmployeeController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/profile', [EmployeeController::class, 'profile']);
    Route::post('/logout', [EmployeeController::class, 'logout']);
});

