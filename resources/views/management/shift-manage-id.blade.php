@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="/manage-shifts" style="color:white">
        Back </a>

    <br><br>

    <!-- Get data from shift_emp table -->

    <!--Employee Name-->
    <h3>{{ $shift->first_name }} {{ $shift->last_name }}</h3>

    <hr>

    <!--Shift Details-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <td class="w-50">Shift</td>
                    <td class="w-50 font-weight-bold">{{ $shift->shift_name }}</td>
                </tr>
                <tr>
                    <td class="w-50">From Date</td>
                    <td class="w-50 font-weight-bold">{{ date('Y/m/d', strtotime($shift->start_date)) }}</td>
                </tr>
                <tr>
                    <td class="w-50">To Date</td>
                    <td class="w-50 font-weight-bold">{{ date('Y/m/d', strtotime($shift->end_date)) }}</td>
                </tr>
                <tr>
                    <td class="w-50">Schedule</td>
                    <td class="w-50 font-weight-bold">
                        <span id="start_time">
                            {{ date('h:i A', strtotime($shift->start_time)) }}
                        </span>
                         - 
                        <span id="end_time">
                            {{ date('h:i A', strtotime($shift->end_time)) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="w-50">No. of Hours</td>
                    <td class="w-50 font-weight-bold" id="time_difference">8</td>
                </tr>
                <tr>
                    <td class="w-50 font-italic">Supervisor/Manager</td>
                    <td class="w-50 font-weight-bold font-italic">{{ $supervisor->first_name }} {{ $supervisor->last_name }}({{ $supervisor->position }})</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#management").addClass('active');

        var start_time = new Date("01/01/2007 " + $('#start_time').text());
        var end_time = new Date("01/01/2007 " + $('#end_time').text());

        var diff = (end_time - start_time) / 60000;

        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;

        $('#time_difference').text((start_time > end_time)? 24 + hours : hours);
    });
</script>
@endsection