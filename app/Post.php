<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'text', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
        
    }
    public function post_comments()
    {
        return $this->hasMany('App\PostComment');
        
    }
}
