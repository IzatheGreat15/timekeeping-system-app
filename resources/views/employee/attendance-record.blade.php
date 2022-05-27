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

    <!-- Success Message -->
    @if ($message = Session::get('success'))
        <ul class="list-group mb-3">
            <li class="list-group-item list-group-item-success mb-3">{{ $message }}</li>
        </ul>
    @endif

    <!-- Error Message -->
    @if ($message = Session::get('error'))
        <ul class="list-group">
            <li class="list-group-item list-group-item-danger mb-3">{{ $message }}</li>
        </ul>
    @endif

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
            @if(Auth::user()->role == 'Management')
            <div class="col-sm mb-3">
                <label>Employee: </label>
                <input type="text" class="form-control" name="name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
            </div>
            @endif
        </div>
    </form>

    <!-- Get data from attendance table --> 

    <!--Attendace Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center" id="table">
                <thead>
                    <tr>
                        <!--Name shown only for management-->
                        @if(Auth::user()->role == 'Management')
                        <th scope="col">Name</th>
                        @endif
                        <th scope="col">Date</th>
                        <th scope="col">Day</th>
                        <th scope="col">Shift</th>
                        <th scope="col" style="font-size: 14px">Time <br> In(1)</th>
                        <th scope="col" style="font-size: 14px">Time <br> Out(1)</th>
                        <th scope="col" style="font-size: 14px">Time <br> In(2)</th>
                        <th scope="col" style="font-size: 14px">Time <br> Out(2)</th>
                        <th scope="col" style="font-size: 14px">Time <br> In(3)</th>
                        <th scope="col" style="font-size: 14px">Time <br> Out(3)</th>
                        <th scope="col" style="font-size: 14px">Total <br> Hrs</th>
                        <th scope="col" style="font-size: 14px">Tardy</th>
                    </tr>
                </thead>

                <tbody>
                @if($requests->count() > 0)
                    @foreach($requests as $req)
                    <!--Each row can be clicked redirect to attendance-spec.blade.php-->
                    <tr onclick="window.location='/attendance-records/{{ $req->ID }}';">
                        <!--Name shown only for management-->
                        @if(Auth::user()->role == 'Management')
                        <th scope="col">{{ $req->first_name }} {{ $req->last_name }}</th>
                        @endif
                        <td style="font-size: 14px">{{ date('Y/m/d', strtotime($req->date)) }}</td>
                        <td>{{ date('D', strtotime($req->date)) }}</td>
                        <td style="font-size: 14px">
                            <span id="start_time{{ $loop->iteration }}">
                                {{ date('h:i A', strtotime($req->start_time))  }}
                            </span> 
                            <br>
                            <span id="end_time{{ $loop->iteration }}">
                                {{ date('h:i A', strtotime($req->end_time))  }}
                            </span> 
                        </td>
                        <td id="time_in1{{ $loop->iteration }}">
                            @if($req->time_in1 != NULL)
                                {{ date('h:i A', strtotime($req->time_in1))  }}
                            @else
                                ----
                            @endif
                        </td>
                        <td id="time_out1{{ $loop->iteration }}">
                            @if($req->time_out1 != NULL)
                                {{ date('h:i A', strtotime($req->time_out1))  }}
                            @else
                                ----
                            @endif
                        </td>
                        <td id="time_in2{{ $loop->iteration }}">
                            @if($req->time_in2 != NULL)
                                {{ date('h:i A', strtotime($req->time_in2))  }}
                            @else
                                ----
                            @endif
                        </td>
                        <td id="time_out2{{ $loop->iteration }}">
                            @if($req->time_out2!= NULL)
                                {{ date('h:i A', strtotime($req->time_out2))  }}
                            @else
                                ----
                            @endif
                        </td>
                        <td id="time_in3{{ $loop->iteration }}">
                            @if($req->time_in3 != NULL)
                                {{ date('h:i A', strtotime($req->time_in3))  }}
                            @else
                                ----
                            @endif
                        </td>
                        <td id="time_out3{{ $loop->iteration }}">
                            @if($req->time_out3 != NULL)
                                {{ date('h:i A', strtotime($req->time_out3))  }}
                            @else
                                ----
                            @endif
                        </td>
                        <td id="total_hrs{{ $loop->iteration }}"></td>
                        <td id="tardy{{ $loop->iteration }}"></td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">No confirmed leave requests yet!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#attendance").addClass('active');

        var x, total_hrs = 0;
        for(x = 1; x < $('#table tr').length; x++){
            var y;
            /* get total hours of attendance */
            for(y = 1; y <= 3; y++){
                
                var time_in = ($('#time_in'+y+x).text() !== "----")?  new Date("01/01/2007 " + $('#time_in'+y+x).text()) : 0;
                time_in = time_in == "Invalid Date" ? 0 : time_in;

                var time_out = ($('#time_out'+y+x).text() !== '----')? new Date("01/01/2007 " +  $('#time_out'+y+x).text()) : 0;
                time_out = time_out == "Invalid Date" ? 0 : time_out;

                var diff = (time_out - time_in) / 60000;

                var minutes = diff % 60;
                var hours = (diff - minutes) / 60;
             
                total_hrs += hours;
            }

            total_hrs = (total_hrs > -1)? total_hrs : 0
            $('#total_hrs'+x).text(total_hrs);

            /* get total hours of shift */
            var start_time = new Date("01/01/2007 " + $('#start_time' + x).text());
            var end_time = new Date("01/01/2007 " + $('#end_time' + x).text());

            var diff = (end_time - start_time) / 60000;

            var minutes = diff % 60;
            var hours = (diff - minutes) / 60;

            var shift = (start_time > end_time)? 24 + hours : hours;
            $('#tardy'+x).text(shift-total_hrs);
        }
    });
</script>
@endsection