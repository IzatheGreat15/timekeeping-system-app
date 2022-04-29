@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Manage Account</h2>
    <!--Change information of account-->
    <hr>
    <!-- Form -->
    <form class="mt-5">
        <!--Name-->
        <div class="row mb-3">
            <div class="col-sm">
                <label>First Name</label>
                <input type="text" class="form-control" value="John"/>
            </div>
            <div class="col-sm">
                <label>Last Name</label>
                <input type="text" class="form-control" value="Doe"/>
            </div>
        </div>

        <!--Email and Status-->
        <div class="row mb-3">
            <div class="col-sm">
                <label>Email Address</label>
                <input type="text" class="form-control" value="johndoe@email.com"/>
            </div>
            <div class="col-sm">
                <label>Status</label>
                <input type="text" class="form-control" value="ACTIVE" readonly/>
            </div>
        </div>

        <!--Department and Position-->
        <div class="row mb-3">
            <div class="col-sm">
                <label>Department</label>
                <input type="text" class="form-control" value="Marketing" readonly/>
            </div>
            <div class="col-sm">
                <label>Job Title</label>
                <input type="text" class="form-control" value="Salesperson" readonly/>
            </div>
        </div>

        <!-- Show ony if applicable -->

        <!-- Substitute -->
        <div class="row mb-3">
            <div class="col-sm">
                <label>Substitute</label>
                <input type="text" class="form-control" value="Sherlock Holmes" readonly/>
            </div>
        </div>

        <!-- Aprrovers -->
        <div class="row mb-5">
            <div class="col-sm">
                <label>Position of Approver 1</label>
                <input type="text" class="form-control" value="John Watson" readonly/>
            </div>
            <div class="col-sm">
                <label>Position of Approver 2</label>
                <input type="text" class="form-control" value="Jim Moriarty" readonly/>
            </div>
        </div>

        <button type="button" class="btn btn-block">Confirm</button>
    </form>
</div>
<script>
</script>
</div>

@endsection