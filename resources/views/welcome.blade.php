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
        <div class = "col-lg-4 col-lg-offset-4" style=" padding-top: 40px;">        
            @include('welcome-page.staff')
        </div>
    </div>
    

@endsection
