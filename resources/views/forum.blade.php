@extends('layouts.config')

@section('body')
    @include('auth.login')
    <div class="row" id="forum">
        <div class="col-lg-6 col-lg-offset-3">
            <forum
                userid={{ Auth::user()->id }}
                username = "{{ Auth::user()->name}}"
                isteacher = {{Auth::user()->isTeacher}}
                isadmin = {{Auth::user()->isadmin}}
            ></forum>
        </div>
    </div>
    
    

@endsection