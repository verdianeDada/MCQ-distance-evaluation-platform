<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\TestPaper;
use App\User;
use App\WrittenTestPaper;
use App\RepeatingCourse;
use App\Course;

class StudentDashboardController extends Controller
{
    public function index()
    {
        try{
            // look for testpapers
            $user = Auth::user();

            $temp = RepeatingCourse::where('user_id', Auth::user()->id)->get();
            if (!empty($temp)){
                $repeatingCoursesId = array();
                foreach($temp as $rc){                    
                    array_push($repeatingCoursesId, $rc->course_id);
                }
                $repeatingCourses = Course::whereIn('id', $repeatingCoursesId)->with('user')->orderBy('code')->get();
            }

            $courses = Course::where([
                            ['year',$user->year],
                            ['option',$user->option],
                        ])
                        ->orWhere([
                            ["year", $user->year],
                            ["isCommon", 1]
                        ])->with('user')->orderBy('code')->get();

            //testpapers
            $now = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s"))+3600);

            $testpapers = TestPaper::with(['course'=>function($query) use ($user){
                $query->where([
                    ['courses.year', $user->year],
                    ['courses.option', $user->option],
                ])
                ->orWhere([
                    ["courses.year", $user->year],
                    ["courses.isCommon", 1]
                ]);
            }])->orderBy('updated_at', 'desc')->get();

            $todayTestpapers = array();

            $writtenTestPapers = WrittenTestPaper::where('user_id', Auth::user()->id)->get();

            if (sizeof($testpapers)){
                foreach($testpapers as $keyT => $test){
                    if ( !empty($test->course)){
                        if (strtotime($test->date.' '.$test->end_time) > strtotime($now) ){
                            $testpapers[$keyT]->obsolete = false;         
                            if ($test->date == date("Y-m-d", strtotime($now))){
                                if (sizeof($writtenTestPapers) > 0){
                                    foreach ( $writtenTestPapers as $wrt){                                    
                                        if ($test->id == $wrt->test_paper_id){
                                            $test->mark_obtained = $wrt->mark_obtained;
                                            $test->done = true;
                                            break;
                                        }
                                        else{
                                            $test->done = false;
                                        }
                                    }
                                } 
                                array_push($todayTestpapers, $test);
                            }             
                        }
                        else {
                            $testpapers[$keyT]->obsolete = true;
                            $testpapers[$keyT]->mark_obtained = 0;
                            if (sizeof($writtenTestPapers) > 0){
                                foreach ( $writtenTestPapers as $wrt){
                                    if ($test->id == $wrt->test_paper_id){
                                        $testpapers[$keyT]->mark_obtained = $wrt->mark_obtained;
                                        $testpapers[$keyT]->done = true;
                                        break;
                                    }
                                    else{
                                        $testpapers[$keyT]->done = false;
                                    }
                                }
                            }

                        }
                    }
                    else{
                        unset($testpapers[$keyT]);
                    }
                }
            }
            
            //repeating testpapers

            if (!empty($repeatingCourses)){
                $repeatingTestpapers = TestPaper::with('course')->whereIn('course_id', $repeatingCoursesId)->get();

                if (sizeof($repeatingTestpapers) > 0){
                    foreach($repeatingTestpapers as $keyT => $test){
                        if (strtotime($test->date.' '.$test->end_time) > strtotime($now) ){
                            $repeatingTestpapers[$keyT]->obsolete = false;         
                            if ($test->date == date("Y-m-d", strtotime($now))){  
                                array_push($todayTestpapers, $test);
                            }             
                        }
                        else {
                            $repeatingTestpapers[$keyT]->obsolete = true;
                            $repeatingTestpapers[$keyT]->mark_obtained = 0;
                            if (sizeof($writtenTestPapers) > 0){
                                foreach ( $writtenTestPapers as $wrt){
                                    if ($test->id == $wrt->test_paper_id){
                                        $repeatingTestpapers[$keyT]->mark_obtained = $wrt->mark_obtained;
                                        $repeatingTestpapers[$keyT]->done = true;
                                        break;
                                    }
                                    else{
                                        $repeatingTestpapers[$keyT]->done = false;
                                    }
                                }
                            }

                        }
                    }
                }
            }
           
            return [
                'courses'=>$courses,
                'testpapers'=>$testpapers, 
                'repeatingCourses'=>$repeatingCourses, 
                'repeatingTestpapers'=>$repeatingTestpapers,
                'todayTestpapers'=>$todayTestpapers
            ];
        }
        catch(\Exception $e){
           return $e->getMessage();
        }
    }
    
}
