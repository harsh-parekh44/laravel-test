<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User1 extends Model
{
    use HasFactory;
    protected $table = 'users1s'; 
    protected $fillable = ['name', 'email', 'password', 'dob', 'phone_number', 'gender'];
}
