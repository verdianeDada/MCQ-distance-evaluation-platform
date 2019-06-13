@extends('layouts.config')
@section('body')
    @include('auth.login')
    <div style="padding: 130px 0; text-align: center">
        <h1 class="bold color" style="font-size: 42px">Sorry, Page Not Found !</h1>
        @if (isset($error))
            <h2 class="color-alarm bold">{{$error}}!</h2>
        @endif
    </div>
@endsection