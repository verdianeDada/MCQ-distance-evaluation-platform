<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PastQuestionAnswer extends Model
{
    protected $fillable = [
        'location', 'description', 'past_question_id'
    ];

    public function past_question()
    {
        return $this->belongsTo('App\PastQuestion');
        
    }
}
