<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestPaper extends Model
{
    protected $fillable = [
        'duration', 'title', 'start_time', 'over_mark', 'course_id',
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
        
    }
    public function questions()
    {
        return $this->hasMany('App\Question');
        
    }
    public function test_report()
    {
        return $this->hasOne('App\TestReport');
        
    }
}
