@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Update data from shift table -->

    <h2>Edit a Shift</h2>

    <hr>

    <!-- Values are populated from the database -->
    
    <!-- Form -->
    <form class="mt-5">

    <!-- Shift Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Shift Name: </label>
                <input type="text" class="form-control">
            </div>
        </div>

        <!-- Shift Times -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Start Time: </label>
                <input type="time" class="form-control"/>
            </div>
            <div class="col-sm mb-3">
                <label>End Time: </label>
                <input type="time" class="form-control"/>
            </div>

            <!-- Automatically calculates no. of hours when start/end time fields change -->
            <div class="col-sm mb-3">
                <label>No. of Hours: </label>
                <input type="text" class="form-control" readonly style="background-color: transparent;"/>
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
    });
</script>
@endsection