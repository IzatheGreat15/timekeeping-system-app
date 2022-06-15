@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Notifications</h2>

    <hr>

    <!--Attendance-->
    <div class="row" id="attendance">
        <div class="col">
            <p>
            <a data-toggle="collapse" href="#attendanceNotif" role="button" aria-expanded="true" class="dropdown-toggle w-100">Attendance</a>
            </p>
        </div>
    </div>

    <div class="collapse.show row" id="attendanceNotif">
        <!--Each container if clicked will redirect to adjustment-spec.blade.php-->
        @foreach($ATT as $a)
        <div class="container notif mb-3 py-3" onclick="window.location={{$a->url}};">
            <a href="{{$a->url}}">{{$a->message}}</a><!--<strong>John Doe</strong> filed an Adjustment Request for the date <strong>03/02/2022</strong>. See more details...-->
        </div>
        @endforeach()
    </div>


    <!--Shift-->
    <div class="row" id="shifts">
        <div class="col">
            <p>
            <a data-toggle="collapse" href="#shiftNotif" role="button" aria-expanded="true" class="dropdown-toggle w-100">Shift</a>
            </p>
        </div>
    </div>

    <div class="collapse.show row" id="shiftNotif">
        <!--Each container if clicked will redirect to shift-change-spec.blade.php-->
        @foreach($SFT as $s)
        <div class="container notif mb-3 py-3" onclick="window.location={{$s->url}};">
            <a href="{{$s->url}}">{{$s->message}}</a><!--<strong>John Doe</strong> filed an Adjustment Request for the date <strong>03/02/2022</strong>. See more details...-->
        </div>
        @endforeach()
    </div>

    <!--Leaves-->
    <div class="row" id="leaves">
        <div class="col">
            <p>
            <a data-toggle="collapse" href="#leaveNotif" role="button" aria-expanded="true" class="dropdown-toggle w-100">Leaves</a>
            </p>
        </div>
    </div>

    <div class="collapse.show row" id="leaveNotif">
        <!--Each container if clicked will redirect to leave-spec.blade.php-->
        @foreach($LVE as $l)
        <div class="container notif mb-3 py-3" onclick="window.location={{$l->url}};">
            <a href="{{$l->url}}">{{$l->message}}</a><!--<strong>John Doe</strong> filed an Adjustment Request for the date <strong>03/02/2022</strong>. See more details...-->
        </div>
        @endforeach()
    </div>

    <!--Overtimes-->
    <div class="row" id="overtime">
        <div class="col">
            <p>
            <a data-toggle="collapse" href="#overtimeNotif" role="button" aria-expanded="true" class="dropdown-toggle w-100">Overtime</a>
            </p>
        </div>
    </div>

    <div class="collapse.show row" id="overtimeNotif">
        <!--Each container if clicked will redirect to overtime-spec.blade.php-->
        @foreach($OVT as $o)
        <div class="container notif mb-3 py-3" onclick="window.location={{$o->url}};">
            <a href="{{$o->url}}">{{$o->message}}</a><!--<strong>John Doe</strong> filed an Adjustment Request for the date <strong>03/02/2022</strong>. See more details...-->
        </div>
        @endforeach()
    </div>
</div>
<script>
</script>
</div>

@endsection