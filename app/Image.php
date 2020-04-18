<?php

namespace App;

use App\Student;
use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id'];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
