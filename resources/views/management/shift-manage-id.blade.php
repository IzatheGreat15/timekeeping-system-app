@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="/manage-shifts" style="color:white">
        Back </a>

    <br><br>

    <!--Employee Name-->
    <h3>John Doe</h3>

    <hr>

    <!--Shift Details-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <td class="w-50">Shift</td>
                    <td class="w-50 font-weight-bold">Graveyard Shift</td>
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
                    <td class="w-50 font-italic">Supervisor/Manager</td>
                    <td class="w-50 font-weight-bold font-italic">Mr. Sherlock Holmes</td>
                </tr>
                <tr>
                    <td class="w-50 font-italic">Supervisor/Manager</td>
                    <td class="w-50 font-weight-bold font-italic">Mr. John Watson</td>
                </tr>
                <tr>
                    <td class="w-50 font-italic">Assigned by</td>
                    <td class="w-50 font-weight-bold font-italic">Mr. Jim Moriarty</td>
                </tr>
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