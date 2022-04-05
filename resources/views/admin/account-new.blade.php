@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Add data to employee table -->

    <h2>Add an Account</h2>

    <hr>

    <!-- Form -->
    <form class="mt-5">

        <!-- Employee Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>First Name: </label>
                <input type="text" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>Last Name: </label>
                <input type="text" class="form-control">
            </div>
        </div>

        <!-- Email and Password -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Email: </label>
                <input type="text" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>Password: </label>
                <input type="text" class="form-control">
            </div>
        </div>

        <!-- Position and Department -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Position: </label>
                <select class="form-control">
                    <option>Employee</option>
                    <option>Manager</option>
                    <option>Supervisor</option>
                    <option>CEO</option>
                </select>
            </div>
            <div class="col-sm mb-3">
                <label>Department: </label>
                <!-- Department from the database -->
                <select class="form-control">
                    <option>Department 1</option>
                    <option>Department 2</option>
                    <option>Department 3</option>
                </select>
            </div>
        </div>

        <!-- Substitute - show only if the position is Manager/Supervisor -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Substitute: </label>
                <!-- Choose another manager/supervisor(same level) from database -->
                <select class="form-control">
                    <option>Sherlock Holmes</option>
                    <option>John Watson</option>
                    <option>Jim Moriarty</option>
                </select>
            </div>
        </div>

        <!-- Direct Managers/Supervisors -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Direct Managers/Supervisors: </label>
                <!-- Choose a manager/supervisor(same department) from database -->
                <select class="form-control">
                    <option>Sherlock Holmes</option>
                    <option>John Watson</option>
                    <option>Jim Moriarty</option>
                </select>
            </div>
            <div class="col-sm mb-3">
                <br>
                <!-- Choose a manager/supervisor(same department) from database -->
                <select class="form-control mt-2">
                    <option>Sherlock Holmes</option>
                    <option>John Watson</option>
                    <option>Jim Moriarty</option>
                </select>
            </div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/accounts" style="color:white">
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