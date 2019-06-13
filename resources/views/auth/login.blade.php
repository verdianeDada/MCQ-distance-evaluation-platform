<div>
    <nav class="navbar">
            <div class="navbar-header">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="right nav navbar-nav">
                    @if (Auth::guest())
                        <form  id="login-form" class="form" method="POST" action="{{ route('login') }}" data-parsley-validate>
                            {{ csrf_field() }}
                              
                                 @if ($errors->has('email'))
                                    <div class="form-group">
                                        <span class="help-block">
                                            <strong class="color-alarm">{{ $errors->first('email') }}</strong>
                                        </span>
                                    </div>
                                @endif
                                @if ($errors->has('password'))
                                    <div class="form-group">
                                        <span class="help-block">
                                            <strong class="color-alarm">{{ $errors->first('password') }}</strong>
                                        </span>
                                    </div>
                                @endif
                            <div class="row margin-0">
                                <div class="form-group col-lg-5">
                                    <div class="row margin-0">
                                        <div class="col-lg-2">
                                            <i class="fa login fa-user color"></i>
                                        </div>
                                        <div class="col-lg-10">
                                            <input id="login-phone" 
                                                type="number" 
                                                class="form-control" 
                                                placeholder="Eg: 672778972"
                                                name="email" 
                                                required ="required"
                                                data-parsley-required-message = ""
                                                data-parsley-length-message = ""
                                                data-parsley-type="digits"
                                                data-parsley-length= "[9,9]"
                                                value="{{ old('email') }}"
                                                autofocus
                                            >
                                        </div>   
                                    </div>                          
                                </div>

                                <div class="form-group col-lg-5">
                                    <div class="row margin-0">
                                        <div class="col-lg-2">
                                            <i class="fa login fa-lock color"></i>
                                        </div>
                                        <div class="col-lg-10">
                                            <input 
                                                id="login-password" 
                                                type="password" 
                                                class="form-control" 
                                                name="password" 
                                                required="required"
                                                data-parsley-required-message = ""
                                                placeholder="Password"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-2">
                                    <div>
                                        <button type="submit" class="btn btn-primary" name="login">
                                            Login
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    
                    @else
                   
                        <div id="app-navbar-collapse" class=" collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="/"><i class="fa fa-home color-black my-li"></i>&nbsp;Home</a></li>
                                <li><a href="/home">Dashboard</a></li>
                            <!-- <li><a href="/home">{{Request::path()}}</a></li> -->
                                
                                
                                @if (Auth::check() && Auth::user()->isTeacher && Auth::user()->isAdmin)
                                    <li><a href="/sitemanagement">Site Mgt</a></li>
                                @endif
                                <!-- @if (Auth::check() && !Ah::user()->isTeacher)
                                    <li><a href="/pastquestion">Past questions</a></li>
                                @endif -->
                                @if (Auth::check() &&  Auth::user()->isAdmin)
                                    <li><a href="/newstaff">News & Staff Mgt</a></li>
                                @endif
                        
                                <!-- <li><a href="/forum-page">Forum</a></li> -->
                                <li class="dropdown">
                                    <div class="my-li">
                                        <i class="dropdown-toggle btn name glyphicon glyphicon-user color-black"
                                            data-toggle="dropdown" role="button" aria-expanded="false"
                                            style="font-size: 23px;"
                                        ><span class="caret"></span></i>
                                    
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="color">{{Auth::user()->name}}</li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif
            </div>
    </nav>
</div>