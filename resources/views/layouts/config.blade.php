<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="{{ asset('images/uplogo.png') }}" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">       

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">        
        <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">        
    </head>
    <body>

    @yield('body')

    <footer class="" style="text-align: center">
        <div class="row">
            <img src="{{ asset('images/logo-enset.png') }}" alt="ENSET logo" style="height: 81px;">
        </div>
        <div class="row">
            <div class="col-lg-4">
                <a href="#">Copyright © 2019</a>
            </div>
            <div class="col-lg-4">
                <a href="http://www.ubastudent.online/student/no_documents">
                    <i class="fa fa-globe" style="font-size: 22px;"></i>&nbsp;Uba Student Online
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#">
                    <i class="fa fa-globe" style="font-size: 22px;"></i>&nbsp;University of Bamenda
                </a>
            </div>
        </div>
    </footer>
    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/parsley.js') }}"></script>    
    <script src="{{ asset('js/myscript.js') }}"></script>
    </body>
</html>