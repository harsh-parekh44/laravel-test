<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;
class marks extends Model
{
    protected $fillable = ['student_id', 'subjects_id', 'marks'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }  
}
