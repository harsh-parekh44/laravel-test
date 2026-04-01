<?php

namespace App\Models;

use APP\Models\Student;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
class StudentProfile extends Model 
{
    protected $fillable = ['student_id','enrollment_no'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}