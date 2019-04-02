<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    protected $fillable = [
        'location', 'title', 'test_paper_id'
    ];

    public function test_paper()
    {
        return $this->belongsTo('App\TestPaper');
        
    }
}
