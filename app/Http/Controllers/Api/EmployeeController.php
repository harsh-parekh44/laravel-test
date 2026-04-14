<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
        // 'data' => new EmployeeResource($employee)
        'data'=> EmployeeResource::collection($employee)
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
    
    public function update(Request $request, $id){
        $employee = Employee::find($id);

        if(!$employee){
             return response()->json([
                'status' => false,
                'message' => 'Employee not found.'
            ], 404); 
        }

        $employee->update($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Employee Updated Successfully.',
        'data' => new EmployeeResource($employee)
    ], 201); 
    }

    public function delete($id){
        $employee = Employee::find($id);
        
        $employee->delete($employee);

    return response()->json([
        'status' => true,
        'message' => 'Employee Deleted Successfully.',
    ], 201); 

    }
    public function profile(Request $request){
        return response()->json([
        // 'status' => true,
        'message'=>'successfully logedin',
        // 'data' => $request->user()
    ],200); 
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
         return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User Registered',
                'token' => $token,
                'data' => $user
        ],201);
    }

    public function login(Request $request){

        if(!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'invalid Credentials'
            ], 401);

            
            }
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'User Registered',
                'token' => $token,
                'data' => $user
        ]);
    }
}