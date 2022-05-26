@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Edit Adjustment Request</h2>

    <hr>

    <!-- Update data from adjustment_emp table --> 

    <!--Value of every field is populated from the database-->
    
    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group mb-3">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    <!--Form Date Filter-->
    <form>
    @csrf
        <!--Date-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Date: </label>
                <input type="date" class="form-control" name="date" max="<?php echo date('Y-m-d'); ?>" value="{{ date('Y-m-d', strtotime($req->date)) }}" >
            </div>
            <div class="col-sm mb-3">
            </div>
        </div>

        <!--Time Ins-->
        <div class="form-row">
            <div class="col-sm mb-3 mx-3">
                <label>Time In 1: </label>
                <input type="time" name="time_in1" class="form-control" value="{{ date('H:i', strtotime($req->time_in1))  }}">
            </div>
            <div class="col-sm mb-3 mx-3">
                <label>Time In 2: </label>
                <input type="time" name="time_in2" class="form-control" value="{{ date('H:i', strtotime($req->time_in2))  }}">
            </div>
            <div class="col-sm mb-3 mx-3">
                <label>Time In 3: </label>
                <input type="time" name="time_in3" class="form-control" value="{{ date('H:i', strtotime($req->time_in3))  }}">
            </div>
        </div>

        <!--Time Outs-->
        <div class="form-row">
            <div class="col-sm mb-3 mx-3">
                <label>Time Out 1: </label>
                <input type="time" name="time_out1" class="form-control" value="{{ date('H:i', strtotime($req->time_out1))  }}">
            </div>
            <div class="col-sm mb-3 mx-3">
                <label>Time Out 2: </label>
                <input type="time" name="time_out2" class="form-control" value="{{ date('H:i', strtotime($req->time_out2))  }}">
            </div>
            <div class="col-sm mb-3 mx-3">
                <label>Time Out 3: </label>
                <input type="time" name="time_out3" class="form-control" value="{{ date('H:i', strtotime($req->time_out3))  }}">
            </div>
        </div>

        <!--Reason-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Reason: </label>
                <textarea class="form-control" name="reason">{{ $req->reason }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/adjustment-records" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#attendance").addClass('active');
    });
</script>
@endsection