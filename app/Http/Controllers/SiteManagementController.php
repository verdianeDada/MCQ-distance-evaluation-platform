<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Course;
use App\User;
use App\testPaper;
use App\Question;

class SiteManagementController extends Controller
{
    public function index(){
        return view('site_management');
    }
    public function all_course(){
        $courses = Course::with('user')->orderBy('code')->get();
        $teachers = User::where('isTeacher', 1)->orderBy('name')->get();
        return ['courses'=>$courses,'teachers'=>$teachers];
    }
    public function delete($id){
        $testpapers = TestPaper::where('course_id',$id)->get();
        $tests_id = array();
        $questions_id = array();
        if (sizeof($testpapers) > 0){
            foreach($testpapers as $test){
                array_push($tests_id, $test->id);
            }


            $questions= Question::whereIn('test_paper_id',$tests_id)->get();

            if(sizeof($questions) > 0){
                foreach($questions as $q){
                    array_push($questions_id, $q->id);
                }

            }
            
           DB::table('repeating_courses')->where('course_id', $id)->delete();
            DB::table('written_test_papers')->whereIn('test_paper_id', $tests_id)->delete();
            DB::table('questions')->whereIn('id', $questions_id)->delete();
            DB::table('question_distractors')->whereIn('question_id', $questions_id)->delete();
            DB::table('test_papers')->whereIn('id', $tests_id)->delete();
            Course::destroy($id);
        }
        return;

    }
    public function update($id){
        return Course::where('id', $id)->with('user')->get();
    }
    
}

