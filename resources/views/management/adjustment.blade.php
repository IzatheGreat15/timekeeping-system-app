@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Management 
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Adjustments
    </h6>

    <hr>

    <div class="row">
        <div class="col-md mb-3">
            <br>
            <!--Department Name - shows only if the account is NOT a CEO-->
            <h3>Department Name</h3>
        </div>
        
        <div class="col-md mb-3">
            <form>
                <label>Search: </label>
                <input type="text" class="form-control">
            </form>
        </div>

        <div class="col-sm mb-3">
                <label>Status: </label>
                <select class="form-control">
                    <option>ALL</option>
                    <option>PENDING</option>
                    <option>SENT BACK</option>
                    <option>APPROVED</option>
                    <option>REJECTED</option>
                </select>
            </div>
    </div>

    <!--Attendace Records - show only request whose approval ID is of the user-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-5 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <!--Department shown only for CEO-->
                        <th scope="col">Department</th>
                        <th scope="col">Date Filed</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time In</th>
                        <th scope="col">Time Out</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Status 1</th>
                        <th scope="col">Status 2</th>
                    </tr>
                </thead>

                <tbody>
                    <!--Each row can be clicked redirect to adjustment-approvals-id.blade.php-->
                    <tr onclick="window.location='/adjustment-approvals-id';">
                        <td>John Doe</td>
                        <td>Marketing</td>
                        <td>03/02/22</td>
                        <td>03/02/22</td>
                        <td>04:01AM</td>
                        <td>06:02PM</td>
                        <td>Late</td>
                        <td>PENDING</td>
                        <td>-------</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#management").addClass('active');
    });
</script>
@endsection