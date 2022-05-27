@extends('employee.navbar')

<?php
// Philippines
date_default_timezone_set('Asia/Hong_Kong');
$manila = date('D M j,  Y');
$manila_time = date('h:i:s A');

// US
date_default_timezone_set('America/Montreal');
$new_york = date('D M j,  Y');
$us_time = date('h:i:s A');


// Dubai
date_default_timezone_set('Asia/Dubai');
$dubai = date('D M j,  Y');
$dubai_time = date('h:i:s A');
?>

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg w-100">

    <!-- Time In / Time Out Buttons -->
    <form action="/time-in/{{ $att->ID }}" class="d-inline">
        <button type="submit" class="btn shadow-md" id="ti_btn">Time In</button>
    </form>
    <form action="/time-out/{{ $att->ID }}" class="d-inline">
        <button type="submit" class="btn shadow-md" id="to_btn">Time Out</button>
    </form>
    
    <!-- Real Time Clock -->
    <div class="container bg-light p-2 p-sm-4 mb-3 mt-4 shadow" style="color:#767070;">
        <h1 class="float-right align-middle manila_time">{{ $manila_time }}</h1>
        <h3>Manila, Philippines</h3>
        <h5>{{ $manila }}</h5>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="container bg-light p-2 p-sm-4 mb-3 shadow" style="color:#767070;">
                <h4 class="float-right align-middle" id="us_time">{{ $us_time }}</h4>
                <h4>New York</h4>
                <h5>{{ $new_york }}</h5>
            </div>
        </div>
        <div class="col-sm">
            <div class="container bg-light p-2 p-sm-4 mb-3 shadow" style="color:#767070;">
                <h4 class="float-right align-middle manila_time">{{ $manila_time }}</h4>
                <h4>Singapore</h4>
                <h5>{{ $manila }}</h5>
            </div>
        </div>
        <div class="col-sm">
            <div class="container bg-light p-2 p-sm-4 mb-3 shadow" style="color:#767070;">
                <h4 class="float-right align-middle" id="dubai_time">{{ $dubai_time }}</h4>
                <h3>Dubai</h3>
                <h5>{{ $dubai }}</h5>
            </div>
        </div>
    </div>

    <!-- Get data from attendance table -->

    <!-- 
        Each day, a new row of attendance is created for all users, each time in/time out column will
        be filled out, every time the user times in or out.
    --> 

    <p id="status">{{ $status }}</p>

    <!-- Table for Time in/out records -->
    <div class="container bg-light p-1 p-sm-4 mb-3 shadow" style="color:#767070;">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <!-- Filter Date using Datetime picker
                         Once the id datepick is clicked, a Date picker will display and user can filter
                         a specific date
                    -->
                    <td id="datepick">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                        </svg>
                        Date
                    </td>
                    <td>{{ date('Y/m/d', strtotime($att->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Time In (1)</td>
                    <td id="ti1">
                        @if($att->time_in1 != NULL)
                            {{ date('h:i A', strtotime($att->time_in1))  }}
                        @else
                            ----------
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Time Out (1)</td>
                    <td id="to1">
                        @if($att->time_out1 != NULL)
                            {{ date('h:i A', strtotime($att->time_out1))  }}
                        @else
                            ----------
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Time In (2)</td>
                    <td  id="ti2">
                        @if($att->time_in2 != NULL)
                            {{ date('h:i A', strtotime($att->time_in2))  }}
                        @else
                            ----------
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Time Out (2)</td>
                    <td id="to2">
                        @if($att->time_out2 != NULL)
                            {{ date('h:i A', strtotime($att->time_out2))  }}
                        @else
                            ----------
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Time In (3)</td>
                    <td id="ti3">
                        @if($att->time_in3 != NULL)
                            {{ date('h:i A', strtotime($att->time_in3))  }}
                        @else
                            ----------
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Time Out (3)</td>
                    <td id="to3">
                        @if($att->time_out3 != NULL)
                            {{ date('h:i A', strtotime($att->time_out3))  }}
                        @else
                            ----------
                        @endif
                    </td>
                </tr>
            </div>
            </table>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#time").addClass('active');

        /* display real time clock */
        setInterval(manila_time, 1000);
        setInterval(us_time, 1000);
        setInterval(dubai_time, 1000);

        /* toggle time in and time out buttons */
        if($('#status').text() == 'time_in'){
            $('#ti_btn').prop('disabled', false);
            $('#to_btn').prop('disabled', true);
        } 
        if ($('#status').text() == 'time_out') {
            $('#ti_btn').prop('disabled', true);
            $('#to_btn').prop('disabled', false);
        }
        if ($('#status').text() == 'both') {
            $('#ti_btn').prop('disabled', true);
            $('#to_btn').prop('disabled', true);
        }
    });

    function manila_time() {
    $.ajax({
        url: '/manila_time',
        success: function(data) {
        $('.manila_time').html(data);
        },
    });
    }

    function us_time() {
    $.ajax({
        url: '/us_time',
        success: function(data) {
        $('#us_time').html(data);
        },
    });
    }

    function dubai_time() {
    $.ajax({
        url: '/dubai_time',
        success: function(data) {
        $('#dubai_time').html(data);
        },
    });
    }
</script>
@endsection