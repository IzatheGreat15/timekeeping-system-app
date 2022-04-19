@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Update data from shift table -->

    <h2>Edit a Shift</h2>

    <hr>

    <!-- Values are populated from the database -->
    
    <!-- Form -->
    <form class="mt-5" method="POST" action="/shift-update">
        @csrf 

        <!-- Shift ID -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <input type="hidden" class="form-control" name="id" value="{{ $shift->id }}">
            </div>
        </div>

        <!-- Shift Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Shift Name: </label>
                <input type="text" class="form-control" name="shift_name" value="{{ $shift->shift_name }}">
            </div>
        </div>

        <!-- Shift Times -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Start Time: </label>
                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $shift->start_time }}"/>
            </div>
            <div class="col-sm mb-3">
                <label>End Time: </label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $shift->end_time }}"/>
            </div>

            <!-- Automatically calculates no. of hours when start/end time fields change -->
            <div class="col-sm mb-3">
                <label>No. of Hours: </label>
                <input type="text" class="form-control" id="hours" readonly style="background-color: transparent;"/>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/shifts" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
    
</div>

<script type="text/javascript">
    $(document).ready(function () {
        timeFunc();

        $("#admin").addClass('active');

        $("#start_time").change(function() {
            /* split hours and minutes of the times */
            const time = $("#start_time").val().split(":");

            /* set min of end_time to be 1 hour later than the start_time */
            $("#end_time").prop("min", (parseInt(time[0])+1).toString() + ":" + time[1]);
        });

        $("#start_time, #end_time").change(function() {
            timeFunc();
        });
    });

    function timeFunc(){
        /* split hours and minutes of the times */
        const time1 = $("#start_time").val().split(":");
        const time2 = $("#end_time").val().split(":");

        /* convert minutes to hours and add */
        const hr1 = parseInt(time1[0]) + (parseInt(time1[1]) / 60);
        const hr2 = parseInt(time2[0]) + (parseInt(time2[1]) / 60);
            
        const hour_diff = (hr2-hr1).toFixed(1);

        if(hour_diff !== "NaN"){
            $("#hours").val(hour_diff);
            if($("#hours").val() < 1){
                $("#hours").addClass("border border-danger");
            } else {
                $("#hours").removeClass("border border-danger");
            }
        }
    }
</script>
@endsection