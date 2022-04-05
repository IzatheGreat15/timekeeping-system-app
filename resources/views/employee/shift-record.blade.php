@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Shifts 
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Records
    </h6>

    <hr>

    <!-- Get data from shift_emp table --> 

    <!--Form Date Filter-->
    <form>
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="date" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="date" class="form-control">
            </div>
            <!--For Management Only-->
            <div class="col-sm mb-3">
                <label>Employee: </label>
                <input type="text" class="form-control" placeholder="John Doe">
            </div>
        </div>
    </form>

    <!--Shift Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Date Filed</th>
                        <!--Name shown only for management-->
                        <th scope="col">Name</th>
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Shift</th>
                        <th scope="col">Schedule</th>
                    </tr>
                </thead>

                <tbody>
                    <!--Each row can be clicked redirect to shift-spec.blade.php-->
                    <tr onclick="window.location='/shift-records-id';">
                        <!--Name shown only for management-->
                        <td>03/02/22</td>
                        <td>John Doe</td>
                        <td>03/02/22</td>
                        <td>03/02/22</td>
                        <td>Graveyard Shift</td>
                        <td>04:00AM <br> 06:00PM</td>
                    </tr>
                    <tr onclick="window.location='/shift-records-id';">
                        <!--Name shown only for management-->
                        <td>03/02/22</td>
                        <td>John Doe</td>
                        <td>03/02/22</td>
                        <td>03/02/22</td>
                        <td>Graveyard Shift</td>
                        <td>04:00AM <br> 06:00PM</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#shift").addClass('active');
    });
</script>
@endsection