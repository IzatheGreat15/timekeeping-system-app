@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Management 
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Records
    </h6>

    <!-- Get data from employee table --> 

    <hr>

    <div class="row">
        <div class="col-md mb-3">
            <br>
            <!--Department Name - shows only if the account is NOT a CEO-->
            <h3>{{$dept->dept_name}}</h3>
        </div>
        
        <div class="col-md mb-3">
            <label>Search: </label>
            <input type="text" class="form-control">
        </div>

        <div class="col-sm mb-3">
                <label>Status: </label>
                <select class="form-control">
                    <option>ALL</option>
                    <option>ACTIVE</option>
                    <option>INACTIVE</option>
                </select>
            </div>
    </div>

    <!--Employee Records under the Department of the Manager/Supervisor-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Employee</th>
                        <th scope="col">Date Employed</th>
                        <th scope="col">Shift</th>
                        <!--Department Column will only show if the account is of CEO-->
                        <th scope="col">Department</th>
                        <th scope="col">Position</th>
                        <th scope="col">Manager/ <br> Supervisor</th>
                        <th scope="col">Manager/ <br> Supervisor</th>
                        <th scope="col">Substitute</th>
                        <th scope="col">STATUS</th>
                    </tr>
                </thead>

                <tbody>
                    <!--Each row can be clicked redirect to employee-spec.blade.php-->
                    @foreach($list as $emp)
                    <tr onclick="window.location='/employee-records-id/{{$emp->id}}';">
                        <td>{{$emp->uFN.' '.$emp->uLN}}</td>
                        <td>{{date('M d, Y', strtotime($emp->created_at))}}</td>
                        <td>{{$emp->shift_name}}</td>
                        <td>{{$emp->dept_name}}</td>
                        <td>{{$emp->position}}</td>
                        <td>{{$emp->a1FN.' '.$emp->a1LN}}</td>
                        <td>{{$emp->a2FN.' '.$emp->a2LN}}</td>
                        <td>{{$emp->sFN.' '.$emp->sLN}}</td>
                        <td>{{$emp->status}}</td>
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