@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="/adjustment-records" style="color:white">
        Back </a>

    <!-- Get data from adjustment_emp table --> 
    
    <!-- Employee, Date and Day -->
    <h2>
        <div class="row">
            <div class="col-md mt-3">
                {{ $req->first_name }} {{ $req->last_name }}
            </div>
            <div class="col-md mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                </svg>
                {{ date('D M j  Y', strtotime($req->date)) }}
            </div>
        </div>
    </h2>

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
        
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50" colspan="2">Request to change to:</td>
                    </tr>
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

    <div class="row">
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Reason</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Postion of Approver 1</td>
                        <td class="w-50 font-weight-bold font-italic">Mr. Mycroft Holmes (Datetime)</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 1</td>
                        <td class="w-50 font-weight-bold font-italic">SENT BACK</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Remarks</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Postion of Approver 2</td>
                        <td class="w-50 font-weight-bold font-italic">Mr. Mycroft Holmes (Datetime)</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 2</td>
                        <td class="w-50 font-weight-bold font-italic">PENDING</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Remarks</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </td>
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