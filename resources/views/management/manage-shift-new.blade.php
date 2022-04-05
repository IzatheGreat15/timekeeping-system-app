@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>New Shift Entry</h2>

    <hr>

    <!-- Add data to shift_emp table -->

    <br>

    <form>
        <!--Select an Emloyee - under the account-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Employee</label>
                <select class="form-control">
                    <option>Employee 1</option>
                </select>
            </div>
        </div>

        <!--Date-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>From</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>To</label>
                <input type="date" class="form-control">
            </div>
        </div>

        <!--Select a Shift - from database-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Shift</label>
                <select class="form-control">
                    <option>Shift 1</option>
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