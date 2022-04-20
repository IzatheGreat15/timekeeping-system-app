@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="/attendance-records" style="color:white">
        Back </a>

    <!-- Get data from attendance table --> 

    <!-- Employee, Date and Day -->
    <h2>
        <div class="row">
            <div class="col-md mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                </svg>
                John Doe
            </div>
            <div class="col-md mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                </svg>
                March 03, 2022
            </div>
            <div class="col-md mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                </svg>
                Thu
            </div>
        </div>
    </h2>

    <hr>

    <!--Attendance Details-->
    <div class="row">
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50">Shift</td>
                        <td class="w-50 font-weight-bold">04:00AM - 06:00PM</td>
                    <tr>
                    <tr>
                        <td class="w-50">Total Hrs:</td>
                        <td class="w-50 font-weight-bold">8</td>
                    <tr>
                    <tr>
                        <td class="w-50">Reg Hrs:</td>
                        <td class="w-50 font-weight-bold">8</td>
                    <tr>
                    <tr>
                        <td class="w-50">MP Hrs:</td>
                        <td class="w-50 font-weight-bold">8</td>
                    <tr>
                    <tr>
                        <td class="w-50">Tardy:</td>
                        <td class="w-50 font-weight-bold">8</td>
                    <tr>
                    <tr>
                        <td class="w-50">Absence:</td>
                        <td class="w-50 font-weight-bold">8</td>
                    <tr>
                    <tr>
                        <td class="w-50 font-italic">Supervisor/Manager</td>
                        <td class="w-50 font-weight-bold font-italic">Mr. Sherlock Holmes</td>
                    <tr>
                </table>
            </div>
        </div>
        
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
        <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50">Time In (1)</td>
                        <td class="w-50 font-weight-bold">04:01AM</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (1)</td>
                        <td class="w-50 font-weight-bold">04:01AM</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (2)</td>
                        <td class="w-50 font-weight-bold">04:01AM</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (2)</td>
                        <td class="w-50 font-weight-bold">04:01AM</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (3)</td>
                        <td class="w-50 font-weight-bold">04:01AM</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (3)</td>
                        <td class="w-50 font-weight-bold">04:01AM</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#attendance").addClass('active');
    });
</script>
@endsection