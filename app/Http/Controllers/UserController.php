<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Course;
use App\WrittenTestPaper;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function delete($id){
        DB::table('repeating_courses')->where('user_id', $id)->delete();
        DB::table('written_test_papers')->where('user_id', $id)->delete();
        DB::table('users')->where('id', $id)->delete();
        return;
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

    if (!$req['isTeacher'])
        return DB::table('users')->where('id', $req['id'])->update([
            'name' => $req['name'],
            'phone' => $req['phone'],
            'sex' => $sex,
            'option' => $req['option'],
            'matricule' => strtolower($req['matricule']),
            'year' => $req['year'],
            'password' => bcrypt($req['password']),
            ]);
    else
        return DB::table('users')->where('id', $req['id'])->update([
            'name' => $req['name'],
            'phone' => $req['phone'],
            'sex' => $sex,
            'isTeacher' => true,
            'password' => bcrypt($req['password']),
        ]);
    }
}
