@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Add data to shift table -->

    <h2>Add a Shift</h2>

    <hr>

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group mb-3">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Form -->
    <form class="mt-5" method="POST" action="/add-new-shift">
        @csrf
        <!-- Shift Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Shift Name: </label>
                <input type="text" name="shift_name" class="form-control" required>
            </div>
        </div>

        <!-- Shift Times -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Start Time: </label>
                <input type="time" id="start_time" name="start_time" class="form-control" required/>
            </div>
            <div class="col-sm mb-3">
                <label>End Time: </label>
                <input type="time" id="end_time" name="end_time" class="form-control" required/>
            </div>

            <!-- Automatically calculates no. of hours when start/end time fields change -->
            <div class="col-sm mb-3">
                <label>No. of Hours: </label>
                <input type="text" id="hours" class="form-control" readonly style="background-color: transparent;"/>
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
        $("#admin").addClass('active');

        $("#start_time").change(function() {
            /* split hours and minutes of the times */
            const time = $("#start_time").val().split(":");

            /* set min of end_time to be 1 hour later than the start_time */
            $("#end_time").prop("min", (parseInt(time[0])+1).toString() + ":" + time[1]);
        });

        $("#start_time, #end_time").change(function() {
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
        });
    });
</script>
@endsection