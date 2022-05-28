@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Management 
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Overtimes
    </h6>

    <!-- Get data from overtime_emp table -->

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

    <!--Overtime Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Date Filed</th>
                        <!--Department shown only for CEO-->
                        <th scope="col">Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Date</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">No. of Hrs</th>
                        <th scope="col">Reason</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($list as $emp)
                    <!--Each row can be clicked redirect to overtime-approval-id.blade.php-->
                    <tr onclick="window.location='/overtime-approvals-id/{{$emp->id}}';">
                        <td>{{date('M d, Y', strtotime($emp->file_date))}}</td>
                        <td>{{$emp->first_name.' '.$emp->last_name}}</td>
                        <td>{{$emp->dept_name}}</td>
                        <td>{{date('M d, Y', strtotime($emp->date))}}</td>
                        <td>{{date('g:i A', strtotime($emp->start_time))}}</td>
                        <td>{{date('g:i A', strtotime($emp->end_time))}}</td>
                        @if(strtotime($emp->end_time)-strtotime($emp->start_time) > 0)<td>{{(strtotime($emp->end_time)-strtotime($emp->start_time))/3600}}</td>
                        @else()<td class="w-50 font-weight-bold">{{24+(strtotime($emp->end_time)-strtotime($emp->start_time))/3600}}</td>
                        @endif()
                        <td>{{$emp->reason}}</td>
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