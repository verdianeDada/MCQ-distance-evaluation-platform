<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepeatingCourse extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 
    ];

     public function course_repeat(){

        return $this->belongsTo('App\Course');
    }
}
