<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\TestPaper;
use App\User;

class TestPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;

        $testpapers = TestPaper::with(['course'=>function($query) use ($id){
            $query->where('user_id','=', $id);
        }])->get();

        return $testpapers;
        
    }

    // $classPapers = TestPaper::with(['course'=>function($query) use ($course){
    //                 $query->where([
    //                         ['courses.option','=',$course->option],
    //                         ['courses.year','=',$course->year]
    //                         ])
    //                     ->orWhere([
    //                         ['courses.isCommon','=',1],
    //                         ['courses.year','=',$course->year]
    //                         ]);
    //             }])->where([
    //                     ['start_date_time','>=',$request->date.' 07:00:00'],
    //                     ['start_date_time','<=',$request->date.' 15:00:00']
    //                     ])
    //                 ->orderBy('start_date_time', 'asc')->get();
}