@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Notifications</h2>

    <hr>

    <!--Attendance-->
    <div class="row">
        <div class="col">
            <p>
            <a data-toggle="collapse" href="#attendanceNotif" role="button" aria-expanded="true" class="dropdown-toggle w-100">Attendance</a>
            </p>
        </div>
    </div>

    <div class="collapse.show row" id="attendanceNotif">
        <!--Each container if clicked will redirect to adjustment-spec.blade.php-->
        <div class="container notif mb-3 py-3" onclick="window.location='/adjustment-records-id';">
            <strong>John Doe</strong> filed an Adjustment Request for the date <strong>03/02/2022</strong>. See more details...
        </div>
        <div class="container notif mb-3 py-3" onclick="window.location='/adjustment-records-id';">
            <strong>John Doe SENT BACK</strong> your Adjustment Request for the date <strong>03/02/2022</strong>. With the remarks: Elementary, my dear Watson. See more details...
        </div>
    </div>


    <!--Shift-->
    <div class="row">
        <div class="col">
            <p>
            <a data-toggle="collapse" href="#shiftNotif" role="button" aria-expanded="true" class="dropdown-toggle w-100">Shift</a>
            </p>
        </div>
    </div>

    <div class="collapse.show row" id="shiftNotif">
        <!--Each container if clicked will redirect to shift-change-spec.blade.php-->
        <div class="container notif mb-3 py-3" onclick="window.location='/shift-change-id';">
            <strong>John Doe</strong> filed an Shift Change Request for the date <strong>03/02/2022</strong>. See more details...
        </div>
        <div class="container notif mb-3 py-3" onclick="window.location='/shift-change-id';">
            <strong>John Doe SENT BACK</strong> your Shift Change Request for the date <strong>03/02/2022</strong>. With the remarks: Elementary, my dear Watson. See more details...
        </div>
    </div>

    <!--Leaves-->
    <div class="row">
        <div class="col">
            <p>
            <a data-toggle="collapse" href="#leaveNotif" role="button" aria-expanded="true" class="dropdown-toggle w-100">Leaves</a>
            </p>
        </div>
    </div>

    <div class="collapse.show row" id="leaveNotif">
        <!--Each container if clicked will redirect to leave-spec.blade.php-->
        <div class="container notif mb-3 py-3" onclick="window.location='/leave-records-id';">
            <strong>John Doe</strong> filed an Leave Request for the date <strong>03/02/2022</strong>. See more details...
        </div>
        <div class="container notif mb-3 py-3" onclick="window.location='/leave-records-id';">
            <strong>John Doe SENT BACK</strong> your Leave Request for the date <strong>03/02/2022</strong>. With the remarks: Elementary, my dear Watson. See more details...
        </div>
    </div>

    <!--Overtimes-->
    <div class="row">
        <div class="col">
            <p>
            <a data-toggle="collapse" href="#overtimeNotif" role="button" aria-expanded="true" class="dropdown-toggle w-100">Overtime</a>
            </p>
        </div>
    </div>

    <div class="collapse.show row" id="overtimeNotif">
        <!--Each container if clicked will redirect to overtime-spec.blade.php-->
        <div class="container notif mb-3 py-3" onclick="window.location='/overtime-records-id';">
            <strong>John Doe</strong> filed an Overtime Request for the date <strong>03/02/2022</strong>. See more details...
        </div>
        <div class="container notif mb-3 py-3" onclick="window.location='/overtime-records-id';">
            <strong>John Doe SENT BACK</strong> your Overtime Request for the date <strong>03/02/2022</strong>. With the remarks: Elementary, my dear Watson. See more details...
        </div>
    </div>
</div>
<script>
</script>
</div>

@endsection