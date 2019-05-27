<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestPaper extends Model
{
    protected $fillable = [
         'title','date', 'start_time','end_time' ,'over_mark', 'course_id',
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
     public function written_paper_users() {
       return $this->belongsToMany('App\User', 'written_test_papers');
   }
}
