<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Technology;
use App\Models\StudentProfile;
use App\Models\Marks;

class Student extends Model
{
    protected $fillable = ['name' , 'email' , 'phone' , 'gender' , 'age' , 'hobbies' , 'technologies', 'graduation', 'profile_picture'];
    public function technologies(){
        return $this->belongsToMany(Technology::class, 'student_technologies', 'student_id', 'technology_id');
    }

    public function profile(){
        return $this->hasone(StudentProfile::class);
    }

    public function marks(){
        return $this->hasMany(Marks::class);
    }
}
