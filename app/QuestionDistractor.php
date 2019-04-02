<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionDistractor extends Model
{
    protected $fillable = [
        'text', 'isCorrect', 'question_id'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question');
        
    }
}
