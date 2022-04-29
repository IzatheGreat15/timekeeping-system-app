@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Add data to sub_leave table -->

    <h2>Add a Subcategory of Leave</h2>

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
    <form class="mt-5" method="POST" action="/add-new-sub-leave">
        @csrf 
        <!-- Subcategory Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Subcategory Name: </label>
                <input type="text" class="form-control" name="sub_leave_name" required>
            </div>
        </div>

        <!-- Description -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Description: </label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
        </div>

        @if($leaves->count() > 0)
        <!-- Category -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Category: </label>
                <!-- options from the database -->
                <select class="form-control" name="main_leave_ID" required>
                    @foreach ($leaves as $leave)
                    <option value="{{ $leave->id }}">{{ $leave->main_leave_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif

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