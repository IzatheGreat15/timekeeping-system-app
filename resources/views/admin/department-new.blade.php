@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Add data to department table -->

    <h2>Add a Department</h2>

    <hr>

    <!-- Form -->
    <form class="mt-5" method="POST" action="/add-new-department">
    @csrf 
    <!-- Department Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Department Name: </label>
                <input type="text" class="form-control" name="dept_name" required>
            </div>
        </div>

        <!-- Department Description -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Department Description: </label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/departments" style="color:white">
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