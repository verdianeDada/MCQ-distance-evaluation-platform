@extends ('layouts.config')
@section('body')
    @include('auth.login')
    <div class="container-fluid">
        <div class="row" id="newstaff">
            <newstaff></newstaff>
        </div>
    </div>
@endsection