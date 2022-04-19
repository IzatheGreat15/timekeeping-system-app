@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Add data to main_leave table -->

    <h2>Add a Category of Leave</h2>

    <hr>

    <!-- Form -->
    <form class="mt-5" method="POST" action="/add-new-main-leave">
        @csrf 
        <!-- Category Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Category Name: </label>
                <input type="text" name="leave_name" class="form-control" required>
            </div>
        </div>

        <!-- Description -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Description: </label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
        </div>

        <!-- Total Balance -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Total Balance: </label>
                <input type="number" name="total_balance" min="1" class="form-control" required>
            </div>
        </div>

        <!-- Require Supporting Documents -->
        <div class="form-group row">
            <div class="col-sm-4">Require Supporting Documents? </div>
            <div class="col-sm-2">
                <div class="form-check">
                    <select class="form-control" name="req_doc">
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/leaves-category" style="color:white">
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