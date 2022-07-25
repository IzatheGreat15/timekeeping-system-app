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

        <br />

        <!-- Break Times -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Break Time: </label>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Start Time: </label>
                <input type="time" id="break_start1" name="break_start1" class="form-control" value="{{ $shift->break_start1 }}" required/>
            </div>
            <div class="col-sm mb-3">
                <label>End Time: </label>
                <input type="time" id="break_end1" name="break_end1" class="form-control" value="{{ $shift->break_end1 }}" required/>
            </div>

            <!-- Automatically calculates no. of hours when start/end time fields change -->
            <div class="col-sm mb-3">
                <label>No. of Hours: </label>
                <input type="text" id="break_hours1" class="form-control" readonly style="background-color: transparent;"/>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Start Time: </label>
                <input type="time" id="break_start2" name="break_start2" class="form-control" value="{{ $shift->break_start2 }}" />
            </div>
            <div class="col-sm mb-3">
                <label>End Time: </label>
                <input type="time" id="break_end2" name="break_end2" class="form-control" value="{{ $shift->break_end2 }}" />
            </div>

            <!-- Automatically calculates no. of hours when start/end time fields change -->
            <div class="col-sm mb-3">
                <label>No. of Hours: </label>
                <input type="text" id="break_hours2" class="form-control" readonly style="background-color: transparent;"/>
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
        break1();
        break2();

        $("#admin").addClass('active');

        $("#start_time").change(function() {
            /* split hours and minutes of the times */
            const time = $("#start_time").val().split(":");

            /* set min of end_time to be 1 hour later than the start_time */
            $("#end_time").prop("min", (parseInt(time[0])+1).toString() + ":" + time[1]);
        });

        $("#break_start1").change(function() {
            /* split hours and minutes of the times */
            const time = $("#break_start1").val().split(":");

            /* set min of end_time to be 1 hour later than the start_time */
            $("#break_end1").prop("min", (parseInt(time[0])+1).toString() + ":" + time[1]);
        });

        $("#break_start2").change(function() {
            /* split hours and minutes of the times */
            const time = $("#break_start2").val().split(":");

            /* set min of end_time to be 1 hour later than the start_time */
            $("#break_end2").prop("min", (parseInt(time[0])+1).toString() + ":" + time[1]);
        });

        $("#start_time, #end_time").change(function() {
            timeFunc();
        });

        $("#break_start1, #break_end1").change(function() {
            break1();
        });

        $("#break_start2, #break_end2").change(function() {
            break2();
        });
    });

    function timeFunc(){
        var start_time = new Date("01/01/2007 " + $('#start_time').val());
            var end_time = new Date("01/01/2007 " + $('#end_time').val());

            /* split hours and minutes of the times */
            const time = $("#end_time").val().split(":");

            /* set max of break_start1 to be 1 hour earlier than the end_time */
            $("#break_start1").prop("max", (parseInt(time[0])-1).toString() + ":" + time[1]);
            $("#break_end1").prop("max", (parseInt(time[0])-1).toString() + ":" + time[1]);
            $("#break_start2").prop("max", (parseInt(time[0])-1).toString() + ":" + time[1]);
            $("#break_end2").prop("max", (parseInt(time[0])-1).toString() + ":" + time[1]);

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

    function break1(){
        var start_time = new Date("01/01/2007 " + $('#break_start1').val());
            var end_time = new Date("01/01/2007 " + $('#break_end1').val());

            /* split hours and minutes of the times */
            const time = $("#break_end1").val().split(":");

            /* set min of break_start2 to be 1 hour later than the break_end1 */
            $("#break_start2").prop("min", (parseInt(time[0])+1).toString() + ":" + time[1]);

            var diff = (end_time - start_time) / 60000;

            var minutes = diff % 60;
            var hours = (diff - minutes) / 60;

            if(hours !== "NaN"){
                $("#break_hours1").val((start_time > end_time)? 24 + hours : hours);
                if($("#break_hours1").val() < 1){
                    $("#break_hours1").addClass("border border-danger");
                } else {
                    $("#break_hours1").removeClass("border border-danger");
                }
            }
    }

    function break2(){
        var start_time = new Date("01/01/2007 " + $('#break_start2').val());
            var end_time = new Date("01/01/2007 " + $('#break_end2').val());

            var diff = (end_time - start_time) / 60000;

            var minutes = diff % 60;
            var hours = (diff - minutes) / 60;

            if(hours !== "NaN"){
                $("#break_hours2").val((start_time > end_time)? 24 + hours : hours);
                if($("#break_hours2").val() < 1){
                    $("#break_hours2").addClass("border border-danger");
                } else {
                    $("#break_hours2").removeClass("border border-danger");
                }
            }
    }
</script>
@endsection