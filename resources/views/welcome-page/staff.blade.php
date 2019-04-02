<div class="dropdown open">
    <h1 class="dropdown-toggle color bold"
            data-toggle="dropdown" role="button" aria-expanded="false"
        >
            Computer Science Department Staff
            <span class="caret"></span>
        </h1>
    <div class="dropdown-menu">
        <h4 class="bold center color-black " style="padding-top: 15px">Head Of Department</h4>
        @foreach ($hod as $staff)
            <div class="staff-mgt row">
                <div class="col-lg-1 padding-0">
                    <i class="fa fa-user-tie fa-staff color-black"></i>
                </div>
                <div class="col-lg-11 padding-0">
                    <p>
                        <span class="bold capitalize color">{{$staff->name}}:</span>
                        <span> &nbsp;{{$staff->description}}</span><p>
                    <p><strong>Email: &nbsp;</strong>{{$staff->email}} <strong>Phone: &nbsp;</strong>{{$staff->phone}}</p>
                </div>
            </div>
        @endforeach

        <h4 class="bold center color-black " style="padding-top: 15px">Heads Of Options</h4>    
        @foreach ($hoo as $staff)
            <div class="staff-mgt row">
                <div class="col-lg-1 padding-0">
                    <i class="fa fa-user-tie fa-staff color-black"></i>
                </div>
                <div class="col-lg-11 padding-0">
                    <p>
                        <span class="bold capitalize color">{{$staff->name}}:</span>
                        <span> &nbsp;{{$staff->description}}</span><p>
                    <p><strong>Email: &nbsp;</strong>{{$staff->email}} <strong>Phone: &nbsp;</strong>{{$staff->phone}}</p>
                </div>
            </div>
        @endforeach

        <h4 class="bold center color-black " style="padding-top: 15px">Teachers</h4>
        @foreach ($teacher as $staff)
            <div class="staff-mgt row">
                <div class="col-lg-1 padding-0">
                    <i class="fa fa-user-tie fa-staff color-black"></i>
                </div>
                <div class="col-lg-11 padding-0">
                    <p>
                        <span class="bold capitalize color">{{$staff->name}}:</span>
                        <span> &nbsp;{{$staff->description}}</span><p>
                    <p><strong>Email: &nbsp;</strong>{{$staff->email}} <strong>Phone: &nbsp;</strong>{{$staff->phone}}</p>
                </div>
            </div>
        @endforeach
        
        <h4 class="bold center color-black " style="padding-top: 15px">Class Coordinators</h4>
        @foreach ($delegate as $staff)
            <div class="staff-mgt row">
                <div class="col-lg-1 padding-0">
                    <i class="fa fa-user-graduate
                    fa-staff color-black"></i>
                </div>
                <div class="col-lg-11 padding-0">
                    <p>
                        <span class="bold capitalize color">{{$staff->name}}:</span>
                        <span> &nbsp;{{$staff->description}}</span><p>
                    <p><strong>Email: &nbsp;</strong>{{$staff->email}} <strong>Phone: &nbsp;</strong>{{$staff->phone}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>