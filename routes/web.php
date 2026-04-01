<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('register');
})->name('register');

Route::get('/index', [UserController::class, 'index']);

// Route::redirect('/', '/index');

Route::get('/about/{name}', [UserController::class, 'about']);
// Route::view('/about/aniket', 'about');

Route::get('/common', [UserController::class, 'common']);
Route::get('/header', [UserController::class, 'header']);
Route::get('/footer', [UserController::class, 'footer']);

Route::get('/students', [StudentController::class, 'index'])->name('student.form');
Route::post('/students', [StudentController::class, 'store'])->name('student.store');
Route::get('/studentsdata', [StudentController::class, 'studentsData'])->name('student.studentsdata');
Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::get('/students/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');
Route::post('/students/update/{id}', [StudentController::class, 'update'])->name('student.update');
Route::get('/students/search', [StudentController::class, 'search'])->name('student.search');


// Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerUser']);

// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser']);

// Protected route
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('authuser');

// Logout
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/delete-account', [AuthController::class, 'deleteAccount'])->middleware('authuser');
