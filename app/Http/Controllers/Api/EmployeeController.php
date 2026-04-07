<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
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
        'data' => new EmployeeResource($employee)
    ], 201); 
}

public function index()
{
    $employees = Employee::all();

    return EmployeeResource::collection($employees);
    // return response()->json([
    //     'status' => true,
    //     'data' => EmployeeResource::collection($employees)
    // ]);
}

    public function show($id){
        $employee = Employee::find($id);

        if(!$employee){
        return response()->json([
            'status' => false,
            'message' => 'Employee not found!'
        ]);
        }

        return response()->json([
            'status' => true,
            'data' => $employee
        ]);
    }
    
    public function update($id){
        
    }
}