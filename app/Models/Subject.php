<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Marks;
class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subjects_name'];

    public function marks(){
        return $this->hasMany(Marks::class);
    }
}