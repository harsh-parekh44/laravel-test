<?php

use App\Http\Controllers\Api\EmployeeController;


Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');