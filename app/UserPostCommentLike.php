<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPostCommentLike extends Model
{
    protected $fillable = [
        'user_id', 'post_comment_id'
    ];
    
}
