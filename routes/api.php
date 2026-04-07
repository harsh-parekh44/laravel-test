<?php

use App\Http\Controllers\Api\EmployeeController;


Route::post('/employee', [EmployeeController::class, 'store']);
Route::get('/employee', [EmployeeController::class, 'index']);

Route::get('/employee/{id}', [EmployeeController::class, 'show']);
Route::post('/employee/{id}', [EmployeeController::class, 'update']);
