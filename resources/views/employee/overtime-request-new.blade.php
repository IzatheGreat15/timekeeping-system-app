@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>New Overtime Request</h2>

    <hr>

    <!-- Add data from pvertime_emp table -->

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger mb-3">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!--Request Form-->
    <form method="POST" action="/overtime-request-created">
    @csrf
        <!--Date and Times-->
        <div class="form-row mb-4 mt-5">
            <div class="col-sm mb-3">
                <label>Date: </label>
                <input type="date" class="form-control" name="date" required>
            </div>
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="time" class="form-control" name="start_time" required>
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="time" class="form-control" name="end_time" required>
            </div>
            <!--Automatically calculates no. of hours-->
            <div class="col-sm mb-3">
                <label>No. of Hrs: </label>
                <input type="text" class="form-control" style="background-color: transparent;" readonly>
            </div>
        </div>

        <!--Reason-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Reason: </label>
                <textarea class="form-control" name="reason" required></textarea>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/overtime-request" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#overtimes").addClass('active');
    });
</script>
@endsection
