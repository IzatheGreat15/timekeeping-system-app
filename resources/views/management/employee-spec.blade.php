@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="/management" style="color:white">
        Back </a>

    <br><br>

    <!-- Get data from employee table --> 
    
    <!--Employee Name-->
    <h3>John Doe</h3>

    <hr>

    <!--Employee Details-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <td class="w-50">Shift</td>
                    <td class="w-50 font-weight-bold">Graveyard Shift</td>
                </tr>
                <tr>
                    <td class="w-50">Email</td>
                    <td class="w-50 font-weight-bold">johndoe@email.com</td>
                </tr>
                <tr>
                    <td class="w-50">Position</td>
                    <td class="w-50 font-weight-bold">Employee</td>
                </tr>
                <tr>
                    <td class="w-50">Department</td>
                    <td class="w-50 font-weight-bold">Department Name</td>
                </tr>
                <!-- only if not NULL -->
                <tr>
                    <td class="w-50">Manager/Supervisor</td>
                    <td class="w-50 font-weight-bold">Mr. Sherlock Holmes</td>
                </tr>
                <tr>
                    <td class="w-50">Manager/Supervisor</td>
                    <td class="w-50 font-weight-bold">Mr. John Watson</td>
                </tr>
                <!-- only if the position is Manager/Supervisor-->
                <tr>
                    <td class="w-50">Substitute</td>
                    <td class="w-50 font-weight-bold">Mr. Mycroft Holmes</td>
                </tr>
                <tr>
                    <td class="w-50">Date Employed</td>
                    <td class="w-50 font-weight-bold">timestamp</td>
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