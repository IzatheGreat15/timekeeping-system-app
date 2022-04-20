@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <a type="button" class="btn shadow-md bg-danger mb-3" href="/approve-leaves" style="color:white">
        Back </a>

    
    <!-- Get data from leave_emp table --> 

    <!--Employee Name-->
    <h3>John Doe</h3>

    <hr>

    <!--Leave Details-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <td class="w-50">Leave</td>
                    <td class="w-50 font-weight-bold">Magna Carta</td>
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
                    <td class="w-50 font-italic" colspan="2">Reason</td>
                </tr>
                <tr>
                    <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                </tr>
                <tr>
                    <td class="w-50">Supporting Documents</td>
                    <td class="w-50 font-weight-bold">file attached</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
            <div class="table-responsive">
                <table class="table table-hover">
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


    <!--Management Form-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 col-md shadow">
        <!-- Form -->
        <form>
            <!-- value is leave_emp ID -->
            <input type="text" style="display: none;"/>
            
            <div class="form-row mb-4">
                <div class="col-sm mb-3">
                    <label>Comment: </label>
                    <textarea class="form-control"></textarea>
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-sm mb-3">
                    <button class="btn shadow-md bg-danger">Reject</button>
                    <button class="btn shadow-md">Send Back</button>
                    <button class="btn shadow-md bg-success">Approve</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#management").addClass('active');
    });
</script>
@endsection