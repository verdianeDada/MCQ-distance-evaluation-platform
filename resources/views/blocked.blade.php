@extends('layouts.config')
@section('body')
    @include('auth.login')
    <div style="padding: 130px 0; text-align: center">
        <h1 class="bold color-alarm" style="font-size: 42px">Sorry, You are not allowed to use this web appliction!</h1>
        <h1 class="bold color" style="font-size: 42px">Contact the web master!</h1>
    </div>
@endsection