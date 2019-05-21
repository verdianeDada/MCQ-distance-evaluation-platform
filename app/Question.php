<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'text', 'over_mark', 'test_paper_id',
    ];

    public function test_paper()
    {
        return $this->belongsTo('App\TestPaper');
        
    }
    public function distractors()
    {
        return $this->hasMany('App\QuestionDistractor');
        
    }
}
