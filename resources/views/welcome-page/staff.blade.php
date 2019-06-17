<div>
    <h2 data-toggle="collapse" data-target="#dept"  aria-expanded="true" class="center color bold">Computer Science Department Staff
        <div class="expand_caret caret"></div>
    </h2>
    <div id="dept" class="collapse in" style="padding-top: 13px;">
        <h3 class="bold center color-black ">Head Of Department</h3>
        @foreach ($hod as $staff)
            <div class="staff-mgt row">
                <div class="col-lg-1 padding-0">
                    <i class="fa fa-user-tie fa-staff color-black"></i>
                </div>
                <div class="col-lg-11 padding-0">
                    <p>
                        <span class="bold capitalize color">{{$staff->name}}:</span>
                        <span> &nbsp;{{$staff->description}}</span>
                    <p>
                    <div class="row">
                        <p class="col-lg-8"><strong>Email: &nbsp;</strong>{{$staff->email}} </p>
                        <p class="col-lg-3 col-lg-offset-1 padding-0"><strong>Phone: &nbsp;</strong>{{$staff->phone}}</p>

                    </div>
                </div>
            </div>
        @endforeach

        <h3 class="bold center color-black " data-toggle="collapse" aria-expanded="true" data-target="#hoo">Heads Of Options
            <div class="caret expand_caret"></div>
        </h3>
        <div id="hoo" class="collapse in">
        @foreach ($hoo as $staff)
            <div class="staff-mgt row">
                <div class="col-lg-1 padding-0">
                    <i class="fa fa-user-tie fa-staff color-black"></i>
                </div>
                <div class="col-lg-11 padding-0">
                    <p>
                        <span class="bold capitalize color">{{$staff->name}}:</span>
                        <span> &nbsp;{{$staff->description}}</span><p>
                    <div class="row">
                        <p class="col-lg-8"><strong>Email: &nbsp;</strong>{{$staff->email}} </p>
                        <p class="col-lg-3 col-lg-offset-1 padding-0"><strong>Phone: &nbsp;</strong>{{$staff->phone}}</p>

                    </div>
                </div>
            </div>
        @endforeach
        </div>

        <h3 class="bold center color-black " data-toggle="collapse" aria-expanded="true" data-target="#teachers">Teachers
            <div class="caret expand_caret"></div>
        </h3>
        <div class="collapse in" id="teachers">
        @foreach ($teacher as $staff)
            <div class="staff-mgt row">
                <div class="col-lg-1 padding-0">
                    <i class="fa fa-user-tie fa-staff color-black"></i>
                </div>
                <div class="col-lg-11 padding-0">
                    <p>
                        <span class="bold capitalize color">{{$staff->name}}:</span>
                        <span> &nbsp;{{$staff->description}}</span><p>
                    <div class="row">
                        <p class="col-lg-8"><strong>Email: &nbsp;</strong>{{$staff->email}} </p>
                        <p class="col-lg-3 col-lg-offset-1 padding-0"><strong>Phone: &nbsp;</strong>{{$staff->phone}}</p>

                    </div>
                </div>
            </div>
        @endforeach
        </div>
        
        <h3 class="bold center color-black " data-toggle="collapse" aria-expanded="true" data-target="#cco">Class Corrdinators
            <div class="caret expand_caret"></div>
        </h3>
        <div class="collapse in" id="cco">
        @foreach ($delegate as $staff)
            <div class="staff-mgt row">
                <div class="col-lg-1 padding-0">
                    <i class="fa fa-user-graduate
                    fa-staff color-black"></i>
                </div>
                <div class="col-lg-11 padding-0">
                    <p>
                        <span class="bold capitalize color">{{$staff->name}}:</span>
                        <span> &nbsp;{{$staff->description}}</span>
                    <p>
                    <div class="row">
                        <p class="col-lg-8"><strong>Email: &nbsp;</strong>{{$staff->email}} </p>
                        <p class="col-lg-3 col-lg-offset-1 padding-0"><strong>Phone: &nbsp;</strong>{{$staff->phone}}</p>

                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>