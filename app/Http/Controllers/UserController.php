<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Course;
use App\TestPaper;
use App\Question;
use App\WrittenTestPaper;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function load_users(){
        $users = DB::table('users')->orderBy('matricule')->get();
        return ['users' => $users,];
    }
    public function delete($id){
        $user = User::where('id',$id)->get();
        if (sizeof($user) > 0){
            $user = $user[0];
            if ($user->isTeacher){
                $testpapers_o = TestPaper::with(['course'=>function($query) use ($user){
                    $query->where([['courses.user_id',$user->id]]);
                }])->get();

                //cleaning null courses
                $testpapers = array();
                if (sizeof($testpapers_o)){
                    foreach($testpapers_o as $test){
                        if (!empty($test->course))
                            array_push($testpapers, $test);
                    }
                }
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
                    
                    DB::table('questions')->whereIn('id', $questions_id)->delete();
                    DB::table('question_distractors')->whereIn('question_id', $questions_id)->delete();
                    DB::table('test_papers')->whereIn('id', $tests_id)->delete();
                }
            }
            else{
                 DB::table('written_test_papers')->where('user_id', $id)->delete();
                 DB::table('repeating_courses')->where('user_id', $id)->delete();
            }
            DB::table('users')->where('id', $id)->delete();
            return ;
        }
       
    }
    public function block($id){
        $isAllowed =   DB::table('users')->where('id', $id)->value('isAllowed');
        DB::table('users')->where('id', $id)->update(['isAllowed' => !$isAllowed]);
        return;
    }
    public function put_admin($id){
        $isAdmin =   DB::table('users')->where('id', $id)->value('isAdmin');
        DB::table('users')->where('id', $id)->update(['isAdmin' => !$isAdmin]);
        return;
    }
    public function update(Request $req){
        if ( sizeof(User::where([
                ['id', '<>', $req['id']],
                ['phone', $req['phone']],
                ])->get() ) > 0
            ){

            return ['error'=>'Sorry! This phone number already belongs to another one'];
        }
        if ( !$req['isTeacher'] && sizeof(User::where([
            ['id', '<>', $req['id']],
            ['matricule', strtolower($req['matricule'])]
            ])->get())  > 0
            )
            return ['error'=>'Sorry! This matricule already belongs to another one'];

        if ( $req['sex'] === "F")
            $sex = true;
        else 
            $sex = false;

    if (!$req['isTeacher']){
        DB::table('users')->where('id', $req['id'])->update([
        'name' => strtolower($req['name']),
        'phone' => $req['phone'],
        'sex' => $sex,
        'option' => $req['option'],
        'matricule' => strtolower($req['matricule']),
        'year' => $req['year'],
        'password' => bcrypt($req['password']),
        ]);
        $user = User::where('id', $req['id'])->get()[0];
      

    }
    else{
         DB::table('users')->where('id', $req['id'])->update([
            'name' => strtolower($req['name']),
            'phone' => $req['phone'],
            'sex' => $sex,
            'password' => bcrypt($req['password']),
        ]);

        $user = User::where('id', $req['id'])->get()[0];
    }
    
    return $user;
    }
}
