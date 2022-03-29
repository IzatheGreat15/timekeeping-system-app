@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Attendance 
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Records
    </h6>

    <hr>

    <!--Form Date Filter-->
    <form>
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="date" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="date" class="form-control">
            </div>
            <!--For Management Only-->
            <div class="col-sm mb-3">
                <label>Employee: </label>
                <input type="text" class="form-control" placeholder="John Doe">
            </div>
        </div>
    </form>

    <!--Attendace Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <!--Name shown only for management-->
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Day</th>
                        <th scope="col">Shift</th>
                        <th scope="col" style="font-size: 14px">Time <br> In(1)</th>
                        <th scope="col" style="font-size: 14px">Time <br> Out(1)</th>
                        <th scope="col" style="font-size: 14px">All <br> Entries</th>
                        <th scope="col" style="font-size: 14px">Total <br> Hrs</th>
                        <th scope="col" style="font-size: 14px">Reg <br> Hrs</th>
                        <th scope="col" style="font-size: 14px">MP <br> Hrs</th>
                        <th scope="col">Tardy</th>
                        <th scope="col">Absence</th>
                    </tr>
                </thead>

                <tbody>
                    <!--Each row can be clicked redirect to attendance-spec.blade.php-->
                    <tr onclick="window.location='/attendance-records-id';">
                        <!--Name shown only for management-->
                        <td>John Doe</td>
                        <td>03/02/22</td>
                        <td>Thu</td>
                        <td style="font-size: 14px">04:00AM <br> 06:00PM</td>
                        <td>04:01AM</td>
                        <td>06:02PM</td>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        </td>
                        <td>8</td>
                        <td>8</td>
                        <td>8</td>
                        <td>8</td>
                        <td>8</td>
                    </tr>
                    <tr onclick="window.location='/attendance-records-id';">
                        <!--Name shown only for management-->
                        <td>John Doe</td>
                        <td>03/02/22</td>
                        <td>Thu</td>
                        <td style="font-size: 14px">04:00AM <br> 06:00PM</td>
                        <td>04:01AM</td>
                        <td>06:02PM</td>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        </td>
                        <td>8</td>
                        <td>8</td>
                        <td>8</td>
                        <td>8</td>
                        <td>8</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#attendance").addClass('active');
    });
</script>
@endsection