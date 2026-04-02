<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    public function store(Request $request){
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:employees',
        'phone' => 'required',
        'department' => 'required',
    ]);

    
    $employee = Employee::create($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Employee Created Successfully.',
        'data' => $employee
    ], 201);
}
}