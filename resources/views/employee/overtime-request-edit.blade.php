@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Edit Overtime Request</h2>

    <hr>

    <!-- Updata data from lovertime_emp table -->

    <!--Values of all fields are populated from the database-->

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group mb-3">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!--Request Form-->
    <form method="POST" action="/overtime-request-edited">
    @csrf

        <!-- Overtime Request ID -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <input type="hidden" class="form-control" name="id" value="{{ $overtimeRequests->id }}">
            </div>
        </div>

        <!--Date and Times-->
        <div class="form-row mb-4 mt-5">
            <div class="col-sm mb-3">
                <label>Date: </label>
                <input type="date" class="form-control" value="{{ $overtimeRequests->date }}">
            </div>
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="time" class="form-control" value="{{ $overtimeRequests->start_time }}">
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="time" class="form-control" value="{{ $overtimeRequests->end_time }}">
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
                <textarea class="form-control">{{ $overtimeRequests->reason }}</textarea>
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
