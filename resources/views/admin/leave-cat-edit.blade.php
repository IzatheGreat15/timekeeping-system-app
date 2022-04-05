@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Update data from main_leave table -->

    <h2>Edit a Category of Leave</h2>

    <hr>

    <!-- Values are populated from the database --> 
    
    <!-- Form -->
    <form class="mt-5">

        <!-- Category Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Category Name: </label>
                <input type="text" class="form-control">
            </div>
        </div>

        <!-- Description -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Description: </label>
                <textarea class="form-control"></textarea>
            </div>
        </div>

        <!-- Total Balance -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Total Balance: </label>
                <input type="number" min="0" class="form-control">
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/leaves-category" style="color:white">
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