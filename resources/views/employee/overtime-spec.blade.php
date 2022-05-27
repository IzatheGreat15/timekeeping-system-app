@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="{{ url()->previous() }}" style="color:white">
        Back </a>

    <br><br>

    <!-- Get data from overtime_emp table --> 

    <!--Employee Name-->
    <h3>{{ $req->first_name}} {{ $req->last_name }}</h3>

    <hr>

    <!--Overtime Details-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <td class="w-50">Date</td>
                    <td class="w-50 font-weight-bold">{{ date('Y/m/d', strtotime($req->date)) }}</td>
                </tr>
                <tr>
                    <td class="w-50">From</td>
                    <td class="w-50 font-weight-bold" id="start_time">{{ date('h:i A', strtotime($req->start_time))  }}</td>
                </tr>
                <tr>
                    <td class="w-50">To</td>
                    <td class="w-50 font-weight-bold" id="end_time">{{ date('h:i A', strtotime($req->end_time))  }}</td>
                </tr>
                <tr>
                    <td class="w-50">No. of Hours</td>
                    <td class="w-50 font-weight-bold" id="time_difference"></td>
                </tr>
                <tr>
                    <td class="w-50 font-italic" colspan="2">Reason</td>
                </tr>
                <tr>
                    <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                        {{ $req->reason }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                <tr>
                        <td class="w-50 font-italic">
                            <!-- Position -->
                            {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $approvals->approval1_ID)
                               ->get()->first()->position }}
                        </td>
                        <td class="w-50 font-weight-bold font-italic">
                            <!-- First Name -->
                            {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $approvals->approval1_ID)
                               ->get()->first()->first_name }} 
                            <!-- Last Name -->
                            {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $approvals->approval1_ID)
                               ->get()->first()->last_name }}
                            <!-- Datetime -->
                            ({{ $req->updated_at1 }})
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 1</td>
                        <td class="w-50 font-weight-bold font-italic">{{ $req->status1 }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Remarks</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                        {{ $req->comment1 }}
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">
                            <!-- Position -->
                            {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $approvals->approval2_ID)
                               ->get()->first()->position }}
                        </td>
                        <td class="w-50 font-weight-bold font-italic">
                            <!-- First Name -->
                            {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $approvals->approval2_ID)
                               ->get()->first()->first_name }} 
                            <!-- Last Name -->
                            {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $approvals->approval2_ID)
                               ->get()->first()->last_name }}
                            <!-- Datetime -->
                            ({{ $req->updated_at2 }})
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 2</td>
                        <td class="w-50 font-weight-bold font-italic">{{ $req->status2 }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Remarks</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                        {{ $req->comment2 }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#overtimes").addClass('active');

        var start_time = new Date("01/01/2007 " + $('#start_time').text());
        var end_time = new Date("01/01/2007 " + $('#end_time').text());

        var diff = (end_time - start_time) / 60000;

        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;

        $('#time_difference').text((start_time > end_time)? 24 + hours : hours);
    });
</script>
@endsection