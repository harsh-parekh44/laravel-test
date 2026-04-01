<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
class Technology extends Model
{
    protected $fillable = ['name'];
    public function students() {
        return $this->belongsToMany(Student::class);
    }
}
