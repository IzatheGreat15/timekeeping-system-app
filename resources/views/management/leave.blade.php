@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Management 
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Leaves
    </h6>

    <!-- Get data from leave_emp table --> 

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

    <!--Leave Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Date Filed</th>
                        <th scope="col">Name</th>
                        <!--Department shown only for CEO-->
                        <th scope="col">Department</th>
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Leave</th>
                        <th scope="col">Status 1</th>
                        <th scope="col">Status 2</th>
                    </tr>
                </thead>

                <tbody>
                    <!--Each row can be clicked redirect to leave-spec.blade.php-->
                    @foreach($list as $emp)
                    <tr onclick="window.location='/leave-approvals-id/{{$emp->id}}';">
                        <td>{{date('M d, Y', strtotime($emp->file_date))}}</td>
                        <td>{{$emp->first_name.' '.$emp->last_name}}</td>
                        <td>{{$emp->dept_name}}</td>
                        <td>{{date('M d, Y', strtotime($emp->start_date))}}</td>
                        <td>{{date('M d, Y', strtotime($emp->end_date))}}</td>
                        <td>{{$emp->main_leave_name}}</td>
                        <td>{{$emp->status1}}</td>
                        <td>{{$emp->status2}}</td>
                    </tr>
                    @endforeach()
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