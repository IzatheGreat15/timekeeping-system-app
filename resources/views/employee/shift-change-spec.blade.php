@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="/shift-change" style="color:white">
        Back </a>

    <br><br>

    <!-- Get data from change_shift_emp table --> 

    <!--Employee Name-->
    <h3>John Doe</h3>

    <hr>

    <!--Shift Details-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <td class="w-50">Assigned Shift</td>
                    <td class="w-50 font-weight-bold">Graveyard Shift</td>
                </tr>
                <tr>
                    <td class="w-50">Requested Shift Change</td>
                    <td class="w-50 font-weight-bold">Graveyard Shift</td>
                </tr>
                <tr>
                    <td class="w-50">Date Filed</td>
                    <td class="w-50 font-weight-bold">03/02/2022</td>
                </tr>
                <tr>
                    <td class="w-50">From Date</td>
                    <td class="w-50 font-weight-bold">03/02/2022</td>
                </tr>
                <tr>
                    <td class="w-50">To Date</td>
                    <td class="w-50 font-weight-bold">03/02/2022</td>
                </tr>
                <tr>
                    <td class="w-50">Schedule</td>
                    <td class="w-50 font-weight-bold">04:00AM - 06:00PM</td>
                </tr>
                <tr>
                    <td class="w-50">No. of Hours</td>
                    <td class="w-50 font-weight-bold">8</td>
                </tr>
                <tr>
                    <td class="w-50 font-italic" colspan="2">Reason</td>
                </tr>
                <tr>
                    <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                </tr>
                <tr>
                    <td class="w-50 font-italic">Supervisor/Manager</td>
                    <td class="w-50 font-weight-bold font-italic">Mr. Sherlock Holmes</td>
                </tr>
                <tr>
                    <td class="w-50 font-italic">Supervisor/Manager</td>
                    <td class="w-50 font-weight-bold font-italic">Mr. John Watson</td>
                </tr>
                <!--If APPROVED-->
                <tr>
                    <td class="w-50 font-italic">Approved by</td>
                    <td class="w-50 font-weight-bold font-italic">Mr. Mycroft Holmes (Datetime)</td>
                </tr>
                <tr>
                    <td class="w-50 font-italic">Approved by</td>
                    <td class="w-50 font-weight-bold font-italic">Mr. Jim Moriarty (Datetime)</td>
                </tr>
            </table>
        </div>
    </div>

        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
            <div class="table-responsive">
                <table class="table table-hover">
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#shift").addClass('active');
    });
</script>
@endsection