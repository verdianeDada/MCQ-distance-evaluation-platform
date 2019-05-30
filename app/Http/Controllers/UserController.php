<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function update(Request $req){
        DB::table('users')->where('id', $req['id'])->update([]);
        return;
    }
}
