@extends('layouts.config')

@section('body')
@include('auth.login')
    <div>
        <div id="write-test">
            <write-test></write-test>
        </div>        
    </div>    

@endsection
