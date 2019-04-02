<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PastQuestion extends Model
{
    protected $fillable = [
        'location', 'description'
    ];

    public function past_question_answer()
    {
        return $this->hasOne('App\PastQuestionAnswer');
        
    }
}
