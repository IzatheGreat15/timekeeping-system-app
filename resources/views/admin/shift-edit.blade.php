@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Update data from shift table -->

    <h2>Edit a Shift</h2>

    <hr>

    <!-- Values are populated from the database -->
    
    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group mb-3">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
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
        var start_time = new Date("01/01/2007 " + $('#start_time').val());
        var end_time = new Date("01/01/2007 " + $('#end_time').val());

        var diff = (end_time - start_time) / 60000;

        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;

        if(hours !== "NaN"){
            $("#hours").val((start_time > end_time)? 24 + hours : hours);
            if($("#hours").val() < 1){
                $("#hours").addClass("border border-danger");
            } else {
                $("#hours").removeClass("border border-danger");
            }
        }
    }
</script>
@endsection