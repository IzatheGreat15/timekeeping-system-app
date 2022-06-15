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

    <!-- Get data from adjustment_emp table --> 

    <hr>

    <div class="row">
        <div class="col-md mb-3">
            <br>
            <!--Department Name - shows only if the account is NOT a CEO-->
            <h3>{{$dept->dept_name}}</h3>
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
                    @if(count($list) < 1)
                        <tr><td colspan="9">
                            <center><h2>No record available.</h2></center>
                        </td></tr>
                    @else()
                        @foreach($list as $emp)
                        <tr onclick="window.location='/adjustment-approvals-id/{{$emp->id}}';">
                            <td>{{$emp->first_name.' '.$emp->last_name}}</td>
                            <td>{{$emp->dept_name}}</td>
                            <td>{{date('M d, Y', strtotime($emp->file_date))}}</td>
                            <td>{{date('M d, Y', strtotime($emp->issue_date))}}</td>
                            <td>{{date('g:i A', strtotime($emp->time_in1))}}</td>
                            <td>{{date('g:i A', strtotime($emp->time_out3))}}</td>
                            <td>{{$emp->reason}}</td>
                            <td>{{$emp->status1}}</td>
                            <td>{{$emp->status2}}</td>
                        </tr>
                        @endforeach()
                    @endif()
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