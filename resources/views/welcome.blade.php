@extends('layouts.config')

@section('body')
    @include('auth.login')
    <div class="index-bg">
        <div id="news" class="row">
            <div class="col-lg-4">
                @include('welcome-page.news')
            </div>
            <div id="register-form" class="col-lg-4 col-lg-offset-4">        
                @include('welcome-page.register')
            </div>
        </div>        
    </div>
    <div class="row welcome-staff">
        <div class = "col-lg-6 col-lg-offset-3 padding-0" style=" padding:25px; margin-top: 17px; background-color: #fff; box-shadow: 0 0 5px #032503, 0 0 5px #163504;">        
            @include('welcome-page.staff')
        </div>
    </div>
    

@endsection
