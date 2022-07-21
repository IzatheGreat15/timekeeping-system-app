@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Edit Shift Entry</h2>

    <hr>

    <!-- Update data from shift_emp table -->

    <br>

    <!--Values of all fields are populated from the database-->
    <form action="/update-manage-shift" method="POST">
        @csrf

        <!-- ID -->
        <input type="hidden" name="id" class="form-control" value="{{ $assigned->id }}">

        <!--Select an Emloyee - under the account-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Employee</label>
                <select class="form-control" name="emp_ID">
                    @foreach($employees as $emp)
                    <option value="{{ $emp->id }}" {{ $assigned->emp_ID == $emp->id? 'selected' : '' }}>{{ $emp->first_name }} {{ $emp->last_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--Date-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>From</label>
                <input type="date" name="start_date" class="form-control" min="<?php echo date('Y-m-d'); ?>" value="{{ $assigned->start_date }}">
            </div>
            <div class="col-sm mb-3">
                <label>To</label>
                <input type="date" name="end_date" class="form-control" value="{{ $assigned->end_date }}">
            </div>
        </div>

        <!--Select a Shift - from database-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Shift</label>
                <select class="form-control" name="shift_ID">
                    @foreach($shifts as $shift)
                    <option value="{{ $shift->id }}" {{ $assigned->shift_ID == $shift->id? 'selected' : '' }}>{{ $shift->shift_name }} ({{ date('g:i A', strtotime($shift->start_time)) }} - {{ date('g:i A', strtotime($shift->end_time)) }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/manage-shifts" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#management").addClass('active');
    });
</script>
@endsection