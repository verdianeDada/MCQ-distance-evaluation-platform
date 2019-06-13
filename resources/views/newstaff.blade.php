@extends ('layouts.config')
@section('body')
    @include('auth.login')
    @if (Auth::user()->isAllowed)
        <div class="container-fluid">
            <div class="row" id="newstaff">
                <newstaff></newstaff>
            </div>
        </div>
    @else
        @include('blocked')
    @endif
    
@endsection