@extends('layouts.config')

@section('body')
    @include('auth.login')
    @if (Auth::user()->isAllowed)
        <div>
            <div id="write-test">
                <write-test></write-test>
            </div>        
        </div>    
    @else
        @include('blocked')
    @endif
@endsection
