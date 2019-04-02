<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentWrittenPaper extends Model
{
    protected $fillable = [
        'user_id', 'test_paper_id','mark'
    ];

   }
