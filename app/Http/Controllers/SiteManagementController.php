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
        
        if (Auth::user()->isAdmin && Auth::user()->isTeacher)
            return view('site_management');
        else{
            $error = "You are not an administrator";
            return view('pagenotfound', compact('error'));
        }   
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
    public function update(Request $req){
        if (sizeof(Course::where([
            ['code', strtolower( $req['code'])],
            ['id','<>' ,$req['id']]
        ])->get()) > 0){
            return ["error" => "This course code is already registered"];
        }
        else{
             if ($req['isCommon'] == 1)
            $req['option'] = NULL;

            Course::findOrFail($req['id'])->update([
                'title'=>$req->input('title'), 
                'year'=>$req->input('year'),
                'credit'=>$req->input('credit'),
                'isCommon'=>$req->input('isCommon'),
                'code'=>strtolower($req->input('code')),
                'option'=>$req->input('option'),
                'user_id'=>$req->input('user_id'),
            ]);
            return "updated";
        }
       
    }
    public function create(Request $req){
        

        if (sizeof(Course::where([
            ['code', strtolower( $req['code'])],
            ['id','<>' ,$req['id']]
        ])->get()) > 0){
            return ["error" => "This course code is already registered"];
        }
        else{
            if ($req['isCommon'] == 1)
                $req['option'] = NULL;

            return Course::create([
                'title'=>$req->input('title'), 
                'year'=>$req->input('year'),
                'credit'=>$req->input('credit'),
                'isCommon'=>$req->input('isCommon'),
                'code'=>strtolower($req->input('code')),
                'option'=>$req->input('option'),
                'user_id'=>$req->input('user_id'),
            ]);
        }
    }
    
}

