<?php

namespace App;

use App\Comment;
use App\Student;
use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    protected $fillable = [
        'Name', 'teacher_id'
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
  
}
