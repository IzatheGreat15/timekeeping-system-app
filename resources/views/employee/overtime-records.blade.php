@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Overtimes 
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Records
    </h6>

    <hr>

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

    <!--Overtime Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Date Filed</th>
                        <!--Name shown only for management-->
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">No. of Hrs</th>
                        <th scope="col">Reason</th>
                    </tr>
                </thead>

                <tbody>
                    <!--Each row can be clicked redirect to overtime-spec.blade.php-->
                    <tr onclick="window.location='/overtime-records-id';">
                        <!--Name shown only for management-->
                        <td>03/02/22</td>
                        <td>John Doe</td>
                        <td>03/02/22</td>
                        <td>04:00AM</td>
                        <td>06:00PM</td>
                        <td>9</td>
                        <td>Late</td>
                    </tr>
                    <tr onclick="window.location='/overtime-records-id';">
                        <!--Name shown only for management-->
                        <td>03/02/22</td>
                        <td>John Doe</td>
                        <td>03/02/22</td>
                        <td>04:00AM</td>
                        <td>06:00PM</td>
                        <td>9</td>
                        <td>Late</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#overtimes").addClass('active');
    });
</script>
@endsection