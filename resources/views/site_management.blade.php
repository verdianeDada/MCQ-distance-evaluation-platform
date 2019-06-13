@extends('layouts.config')

@section('body')
    @include('auth.login')
    @if (Auth::user()->isAllowed)
        <div id ="sitemanagement">
            <sitemanagement>
            </sitemanagement>
        </div> 
    @else
        @include('blocked')
    @endif
       
    

@endsection
