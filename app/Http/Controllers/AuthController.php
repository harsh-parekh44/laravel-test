<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User1;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
        public function register()
    {
        return view('register');
    }

    // Save Register
    public function registerUser(Request $request)
    {
        
        $request->validate([
            'name' => 'min:5|max:255',
            'email' => 'email|unique:users1s',
            'password' => 'min:6',
            'dob' => 'date|before:today',
            'phone_number' => 'numeric|digits:10|unique:users1s',
            'gender' => 'in:male,female,other',
        ]);

        $user = User1::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'dob' => $request->dob,
        'phone_number' => $request->phone_number,
        'gender' => $request->gender,
    ]);
    
    session(['user' => $user]);

    return response()->json(['status' => 'success']);
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'email',
            'password' => 'min:6',
        ]);

        $user = User1::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 401); //401 is unauthorized error
    }

    // Dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

    // Logout
    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }

    public function deleteAccount(Request $request)
{
    $user = session('user');
    if($user) {
        User1::where('id', $user->id)->delete();
        Session::forget('user'); // logout user
        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'error'], 401);
}
}

