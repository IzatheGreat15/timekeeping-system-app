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
            <div class="col">
                <label>First Name</label>
                <input type="text" class="form-control" value="John"/>
            </div>
            <div class="col">
                <label>Last Name</label>
                <input type="text" class="form-control" value="Doe"/>
            </div>
        </div>

        <!--Email-->
        <div class="row mb-5">
            <div class="col">
                <label>Email Address</label>
                <input type="text" class="form-control" value="johndoe@email.com"/>
            </div>
        </div>

        <button type="button" class="btn btn-block">Confirm</button>
    </form>
</div>
<script>
</script>
</div>

@endsection