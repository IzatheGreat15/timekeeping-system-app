@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <h2>Add a Subcategory of Leave</h2>

    <hr>

    <!-- Form -->
    <form class="mt-5">

        <!-- Subcategory Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Subcategory Name: </label>
                <input type="text" class="form-control">
            </div>
        </div>

        <!-- Description -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Description: </label>
                <textarea class="form-control"></textarea>
            </div>
        </div>

        <!-- Category -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Category: </label>
                <!-- options from the database -->
                <select class="form-control">
                    <option>Category 1</option>
                    <option>Category 2</option>
                    <option>Category 3</option>
                </select>
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