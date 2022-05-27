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
            <div class="col-md mt-3">
                {{ $req->first_name }} {{ $req->last_name }}
            </div>
            <div class="col-md mt-3">
                {{ date('D M j,  Y', strtotime($req->date)) }}
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
                        <td class="w-50 font-weight-bold">
                            <span id="start_time">
                                {{ date('h:i A', strtotime($req->start_time))  }}
                            </span> 
                            -
                            <span id="end_time">
                                {{ date('h:i A', strtotime($req->end_time))  }}
                            </span>
                        </td>
                    <tr>
                    <tr>
                        <td class="w-50">Total Hrs:</td>
                        <td class="w-50 font-weight-bold" id="total_hrs"></td>
                    <tr>
                    <tr>
                        <td class="w-50">Tardy:</td>
                        <td class="w-50 font-weight-bold" id="tardy"></td>
                    <tr>
                    <tr>
                        <td class="w-50" colspan="2">Superiors:</td>
                    <tr>
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
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
        <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50">Time In (1)</td>
                        <td class="w-50 font-weight-bold" id="time_in1">
                            @if($req->time_in1 != NULL)
                                {{ date('h:i A', strtotime($req->time_in1))  }}
                            @else
                                ----
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (1)</td>
                        <td class="w-50 font-weight-bold" id="time_out1">
                            @if($req->time_out1 != NULL)
                                {{ date('h:i A', strtotime($req->time_out1))  }}
                            @else
                                ----
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (2)</td>
                        <td class="w-50 font-weight-bold" id="time_in2">
                            @if($req->time_in2 != NULL)
                                {{ date('h:i A', strtotime($req->time_in2))  }}
                            @else
                                ----
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (2)</td>
                        <td class="w-50 font-weight-bold" id="time_out2">
                            @if($req->time_out2 != NULL)
                                {{ date('h:i A', strtotime($req->time_out2))  }}
                            @else
                                ----
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (3)</td>
                        <td class="w-50 font-weight-bold" id="time_in3">
                            @if($req->time_in3 != NULL)
                                {{ date('h:i A', strtotime($req->time_in3))  }}
                            @else
                                ----
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (3)</td>
                        <td class="w-50 font-weight-bold" id="time_out3">
                            @if($req->time_out3 != NULL)
                                {{ date('h:i A', strtotime($req->time_out3))  }}
                            @else
                                ----
                            @endif
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

        var total_hrs;

        var y;
            /* get total hours of attendance */
            for(y = 1; y <= 3; y++){
                
                var time_in = ($('#time_in'+y).text() !== "----")?  new Date("01/01/2007 " + $('#time_in'+y).text()) : 0;
                time_in = time_in == "Invalid Date" ? 0 : time_in;

                var time_out = ($('#time_out'+y).text() !== '----')? new Date("01/01/2007 " +  $('#time_out'+y).text()) : 0;
                time_out = time_out == "Invalid Date" ? 0 : time_out;

                var diff = (time_out - time_in) / 60000;

                var minutes = diff % 60;
                var hours = (diff - minutes) / 60;
             
                total_hrs += hours;
            }

            total_hrs = (total_hrs > -1)? total_hrs : 0
            $('#total_hrs').text(total_hrs);

            /* get total hours of shift */
            var start_time = new Date("01/01/2007 " + $('#start_time').text());
            var end_time = new Date("01/01/2007 " + $('#end_time').text());

            var diff = (end_time - start_time) / 60000;

            var minutes = diff % 60;
            var hours = (diff - minutes) / 60;

            var shift = (start_time > end_time)? 24 + hours : hours;
            $('#tardy').text(shift-total_hrs);
    });
</script>
@endsection