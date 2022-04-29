@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Update data from sub_leave table -->

    <h2>Edit a Subcategory of Leave</h2>

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
    <form class="mt-5" method="POST" action="/sub-leave-update">
        @csrf 
        <!-- Category ID -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <input type="hidden" name="id" class="form-control" value="{{ $leave->id}}" required>
            </div>
        </div>

        <!-- Subcategory Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Subcategory Name: </label>
                <input type="text" name="sub_leave_name" class="form-control" value="{{ $leave->sub_leave_name }}" required>
            </div>
        </div>

        <!-- Description -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Description: </label>
                <textarea name="description" class="form-control" required>{{ $leave->description }}</textarea>
            </div>
        </div>

        <!-- Category -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Category: </label>
                <!-- options from the database -->
                <select name="main_leave_ID" class="form-control" required>
                    @foreach($main as $m)
                        <option value="{{ $m->id }}" {{ $leave->main_leave_ID == $m->id? 'selected' : '' }}>{{ $m->main_leave_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/leaves-subcategory" style="color:white">
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