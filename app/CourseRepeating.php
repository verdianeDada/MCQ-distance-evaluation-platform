<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseRepeating extends Model
{
    protected $fillable = [
        'user_id', 'course_id'
    ];
}
