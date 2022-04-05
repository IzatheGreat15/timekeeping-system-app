@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Edit Change Shift Request</h2>

    <hr>

    <!-- Update data from change_shift_emp table --> 

    <!--Value of all fields are populated from the database-->
    
    <!--Form Date Filter-->
    <form>
        <!--Assigned Shift - choose a shift to change-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Assigned Shift: </label>
                <select class="form-control">
                    <option>Graveyard Shift (12:00AM - 8:00AM) 03/02/2022 - 04/02/2022</option>
                    <option>Another Shift (12:00AM - 8:00AM) 03/02/2022 - 04/02/2022</option>
                </select>
            </div>
        </div>

        <!--Shift Change-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Shift Change to: </label>
                <select class="form-control">
                    <option>Graveyard Shift (12:00AM - 8:00AM)</option>
                    <option>Another Shift (12:00AM - 8:00AM)</option>
                </select>
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
            <a type="button" class="btn shadow-md bg-danger" href="/shift-change" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#shift").addClass('active');
    });
</script>
@endsection