@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Update data from department table -->

    <h2>Edit a Department</h2>

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
    <form class="mt-5" method="POST" action="/department-update">
        @csrf

        <!-- Department ID -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <input type="hidden" class="form-control" name="id" value="{{ $departments->id }}">
            </div>
        </div>

        <!-- Department Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Department Name: </label>
                <input type="text" class="form-control" name="dept_name" value="{{ $departments->dept_name }}">
            </div>
        </div>

        <!-- Department Description -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Department Description: </label>
                <textarea class="form-control" name="description">{{ $departments->description }}</textarea>
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