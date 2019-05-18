<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password','sex', 'isAllowed','isAdmin', 'isTeacher', 'option', 'matricule', 'year'
    ];

    public function courses()
    {
        return $this->hasMany('App\Course');
        
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
        
    }
    public function post_comments()
    {
        return $this->hasMany('App\PostComment');
        
    }
    public function course_repeat(){
        return $this->belongsToMany('App\Course','course_repeatings');
    }
    public function user_written_papers(){
        return $this->belongsToMany('App\TestPaper','written_testpapers')->withPivot('over_mark');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
