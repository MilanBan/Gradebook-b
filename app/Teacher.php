<?php

namespace App;

use App\User;
use App\Image;
use App\Gradebook;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'firstName', 'lastName', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gradebook(){
        return $this->hasOne(Gradebook::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
