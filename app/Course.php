<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = [
        'title', 'code','year', 'user_id','option','isCommon', 'credit'
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }
    public function test_papers()
    {
        return $this->hasMany('App\TestPaper');
    }
    public function course_user_repeat(){

        return $this->belongsToMany('App\User');
    }
}
