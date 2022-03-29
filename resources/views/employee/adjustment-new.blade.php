@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>New Adjustment Request</h2>

    <hr>

    <!--Request Form-->
    <form>
        <!--Date-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Date: </label>
                <input type="date" class="form-control">
            </div>
            <div class="col-sm mb-3">
            </div>
        </div>

        <!--Time Ins-->
        <div class="form-row">
            <div class="col-sm mb-3 mx-3">
                <label>Time In 1: </label>
                <input type="time" class="form-control">
            </div>
            <div class="col-sm mb-3 mx-3">
                <label>Time In 2: </label>
                <input type="time" class="form-control">
            </div>
            <div class="col-sm mb-3 mx-3">
                <label>Time In 3: </label>
                <input type="time" class="form-control">
            </div>
        </div>

        <!--Time Outs-->
        <div class="form-row">
            <div class="col-sm mb-3 mx-3">
                <label>Time Out 1: </label>
                <input type="time" class="form-control">
            </div>
            <div class="col-sm mb-3 mx-3">
                <label>Time Out 2: </label>
                <input type="time" class="form-control">
            </div>
            <div class="col-sm mb-3 mx-3">
                <label>Time Out 3: </label>
                <input type="time" class="form-control">
            </div>
        </div>

        <!--Reason-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Reason: </label>
                <textarea class="form-control"></textarea>
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