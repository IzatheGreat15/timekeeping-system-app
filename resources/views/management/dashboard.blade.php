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

    <hr>

    <div class="row">
        <div class="col-md mb-3">
            <br>
            <!--Department Name - shows only if the account is NOT a CEO-->
            <h3>Department Name</h3>
        </div>
        
        <div class="col-md mb-3">
            <label>Search: </label>
            <input type="text" class="form-control">
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
                        <th scope="col">Substitue</th>
                        <th scope="col">STATUS</th>
                    </tr>
                </thead>

                <tbody>
                    <!--Each row can be clicked redirect to employee-spec.blade.php-->
                    <tr onclick="window.location='/employee-records-id';">
                        <td>John Doe</td>
                        <td>03/02/2022</td>
                        <td>Graveyard Shift</td>
                        <td>Marketing</td>
                        <td>Employee</td>
                        <td>Mr. Sherlock Holmes</td>
                        <td>Mr. John Watson</td>
                        <td>Mr. Jim Moriarty</td>
                        <td>ACTIVE</td>
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