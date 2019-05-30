<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="color bold center">Create an account</h1>
    </div>
    <div class="panel-body">
        <form id="register-form" class="form" method="POST"  
          action="{{ route('register') }}"
          data-parsley-validate
        >
            {{ csrf_field() }}
            <div>
                <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                    <label for="name" class="control-label">Name<strong>&nbsp;*</strong></label>
                    <div class="col-sm-12">
                        <input 
                        placeholder="Eg: Dada " 
                        id="name" type="text" 
                        class="form-control" 
                        name="name" 
                        required = "required"
                        data-parsley-required-message = "Your name is required"
                        data-parsley-maxlength= "32" 
                        value="{{ old('name') }}"
                        >
                    </div>
                </div>

                <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                    <label for="phone" class="control-label">Phone number<strong>&nbsp;*</strong></label>
                    <div class="col-sm-12">
                        <input id="phone" 
                        type="number" 
                        class="form-control" 
                        placeholder="Eg: 672778972"
                        name="phone" 
                        required ="required"
                        data-parsley-required-message = "Your phone number is required"
                        data-parsley-length-message = "Your phone number should have 9 digits"
                        data-parsley-type="digits"
                        data-parsley-length= "[9,9]"
                        value="{{ old('phone') }}"
                        >
                        @if ($errors->has('phone'))
                                    <span class="help-block color-alarm">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                    <label for="password" class="control-label">Password<strong>&nbsp;*</strong></label>
                    <div class="col-sm-12">
                        <input 
                        id="password" 
                        type="password" 
                        class="form-control" 
                        name="password" 
                        required
                        data-parsley-required-message = "Your password is required"
                        data-parsley-minlength= "3"
                        data-parsley-minlength-message = "Your password should have at least 3 characters"
                        value="{{ old('password') }}"
                        >
                    </div>
                </div>

                <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                    <label for="password-confirm" class="control-label">Confirm Password<strong>&nbsp;*</strong></label>
                    <div class="col-sm-12">
                        <input 
                        id ="password-confirm" 
                        type= "password" 
                        class= "form-control" 
                        name= "password_confirm"
                        required= "required"
                        data-parsley-required-message = "Confirm your password"
                        data-parsley-isequal=""
                        value="{{ old('password-confirm') }}"
                        >
                    </div>
                </div>
            </div>
            <div>
                <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                    <label class="control-label">Sex:</label>
                    <div class="col-sm-12">
                        <label for="male" class="radio col-lg-6 col-sm-6 col-xm-12">
                            <input type="radio" name="sex" value="0" checked="" id="male">Male
                        </label>
                        <label for="female" class="radio col-lg-6 col-sm-6 col-xm-12">
                            <input type="radio" name="sex" value="1" id="female">Female
                        </label>
                    </div>
                </div>

                <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                    <label class="control-label">Status:</label>
                    <div class="col-sm-12">
                        <label for="student" class="radio col-lg-6 col-sm-6 col-xm-12">
                            <input type="radio" name="status" value="student" id="student" checked>Student
                        </label>
                        <label for="teacher" class="radio col-lg-6 col-sm-6 col-xm-12">
                            <input type="radio" name="status" value="teacher" id="teacher">Teacher
                        </label>
                    </div>
                </div>
            </div>
            <div id="if-student">
                <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                    <label for="option" class="control-label">Option:</label>
                    <div class="col-sm-12">
                        <select name="option" id="option" class="form-control">
                            <option value="0" selected>Computer Science</option>
                            <option value="1">Information &amp; Communication Technology</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                    <label for="year" class="control-label">Year:</label>
                    <div class="col-sm-12">
                        <select name="year" id="year" class="form-control">
                            <option value="1" selected>Year 1</option>
                            <option value="2">Year 2</option>
                            <option value="3">Year 3</option>
                            <option value="4">Year 4</option>
                            <option value="5">Year 5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-xm-12 col-lg-offset-3">
                    <label for="matricule" class="control-label">Registration number <strong>&nbsp;*</strong></label>
                    <div class="col-sm-12">
                        <input 
                          id ="matricule" 
                          type= "text" 
                          class= "form-control" 
                          name= "matricule"
                          placeholder="Eg: 16T0222"
                          data-parsley-length-message = "Your matricule should have 7 characters"
                          data-parsley-length= "[7,7]"
                          value="{{ old('matricule') }}"
                        >
                        @if ($errors->has('matricule'))
                                    <span class="help-block color-alarm">
                                        <strong>{{ $errors->first('matricule') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>
                                    
            <div class="col-lg-2 col-lg-offset-5 col-sm-offset-5 col-xm-offset-5">
            @if (!Auth::check())
                <button type="submit" class="btn btn-primary" name="register">
                    Register
                </button>
            @else
                <button type="" disabled="true" class="btn btn-primary" >
                    Register
                </button>
            @endif
            </div>
        </form>
    </div>
</div>

