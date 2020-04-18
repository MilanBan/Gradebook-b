<?php

namespace App;

use App\User;
use App\Gradebook;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function gradebook(){
        return $this->belongsTo(Gradebook::class);
    }
}
