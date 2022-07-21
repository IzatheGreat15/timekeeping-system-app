@extends('employee.navbar')

<?php
// Philippines
date_default_timezone_set('Asia/Hong_Kong');
$manila = date('d/m/Y');
?>
@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>New Shift Entry</h2>

    <hr>

    <!-- Add data to shift_emp table -->

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger mb-3">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <br>

    <form action="/add-manage-shift" method="POST">
        @csrf
        <!--Select an Emloyee - under the account-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Employee</label>
                <select class="form-control" name="emp_ID">
                    @foreach($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--Date-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>From</label>
                <input type="date" name="start_date" class="form-control" min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-sm mb-3">
                <label>To</label>
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>

        <!--Select a Shift - from database-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Shift</label>
                <select class="form-control" name="shift_ID">
                    @foreach($shifts as $shift)
                    <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ date('g:i A', strtotime($shift->start_time)) }} - {{ date('g:i A', strtotime($shift->end_time)) }})</option>
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

        $('input[name="end_date"]').attr("min", $('input[name="start_date"]').val());
        
        $('input[name="start_date"]').change(function() {
            $('input[name="end_date"]').attr("min", $('input[name="start_date"]').val());
        });
    });
</script>
@endsection