@extends('layouts.config')
@section('body')
    @include ('auth.login')
    @if (Auth::user()->isAllowed)
        @if(Auth::check() && Auth::user()->isTeacher)   
            <div id="teacher-dashboard" class="container-fluid">
                <teacher-dashboard
                    userid={{ Auth::user()->id }}
                    username = "{{ Auth::user()->name}}"
                    usersex = {{Auth::user()->sex}}
                >
                </teacher-dashboard>
            </div>
        @else
            <div id="student-dashboard" class="container-fluid">
                <student-dashboard>
                    
                </student-dashboard>
            </div>
        @endif
    @else
        @include('blocked')
    @endif

     
@endsection
