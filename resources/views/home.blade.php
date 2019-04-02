@extends('layouts.config')
@section('body')
    @include ('auth.login')
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
        <p>am student board</p>
    @endif
@endsection
