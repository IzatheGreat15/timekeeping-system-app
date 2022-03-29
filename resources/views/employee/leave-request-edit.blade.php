@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Edit Leave Request</h2>

    <hr>

    <!--Value of all fields are populated from the database-->
    
    <!-- Leave Balance -->
    <div class="row mb-3">
        <div class="col-md">
            <div class="container bg-light p-2 p-sm-4 mx-0 mb-3 shadow">
                <h5 class="font-weight-bold">Vacation Leave</h5> <br>
                <p>Balance 12 out of 13</p>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width:90%;" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="container bg-light p-2 p-sm-4 mb-3 shadow">
                <h5 class="font-weight-bold">Sick Leave</h5> <br>
                <p>Balance 5 out of 13</p>
                <div class="progress">
                    <div class="progress-bar bg-danger" style="width:38%;" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="container bg-light p-2 p-sm-4 mb-3 shadow">
                <h5 class="font-weight-bold">Emergency Leave</h5> <br>
                <p>Balance 5 out of 10</p>
                <div class="progress">
                    <div class="progress-bar bg-warning" style="width:50%;" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="container bg-danger text-light p-2 p-sm-4 mb-3 shadow">
                <h5 class="font-weight-bold">Service Incentive Leave</h5>
                <p>Balance 0 out of 13</p>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width:0%;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!--Request Form-->
    <form>
        <p>Date</p>
        <!--Date-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="date" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="date" class="form-control">
            </div>
        </div>

        <!--Leave-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Leave: </label>
                <select class="form-control">
                    <option>Type of Leave 1</option>
                    <option>Type of Leave 2</option>
                </select>
            </div>
        </div>

        <!--Supporting Document (Med Cert only for Sick Leaves)-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Supporting Document: </label> <br>
                <input type="file">
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
            <a type="button" class="btn shadow-md bg-danger" href="/leave-request" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#leaves").addClass('active');
    });
</script>
@endsection