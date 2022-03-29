@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg">
    <button type="button" class="btn shadow-md">Time In</button>
    <button type="button" class="btn shadow-md">Time Out</button>
    
    <!--Real Time Clock-->
    <div class="container bg-light p-2 p-sm-4 mb-3 mt-4 shadow" style="color:#767070;">
        <h1 class="float-right align-middle">7:30:05 PM</h1>
        <h3>Manila, Philippines</h3>
        <h5>March 02, 2022</h5>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="container bg-light p-2 p-sm-4 mb-3 shadow" style="color:#767070;">
                <h3 class="float-sm-right align-middle">7:30:05PM</h3>
                <h3>New York</h3>
                <h5>March 02, 2022</h5>
            </div>
        </div>
        <div class="col-sm">
            <div class="container bg-light p-2 p-sm-4 mb-3 shadow" style="color:#767070;">
                <h4 class="float-sm-right align-middle">7:30:05PM</h4>
                <h3>Singapore</h3>
                <h5>March 02, 2022</h5>
            </div>
        </div>
        <div class="col-sm">
            <div class="container bg-light p-2 p-sm-4 mb-3 shadow" style="color:#767070;">
                <h3 class="float-sm-right align-middle">7:30:05PM</h3>
                <h3>Dubai</h3>
                <h5>March 02, 2022</h5>
            </div>
        </div>
    </div>

    <!--Table for Time in/out records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 shadow" style="color:#767070;">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <!--Filter Date using Datetime picker-->
                    <td id="datepick">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                        </svg>
                        Date
                    </td>
                    <td>03/02/2022</td>
                </tr>
                <tr>
                    <td>Time In (1)</td>
                    <td>07:30:50AM</td>
                </tr>
                <tr>
                    <td>Time Out (1)</td>
                    <td>07:30:50AM</td>
                </tr>
                <tr>
                    <td>Time In (2)</td>
                    <td>----------</td>
                </tr>
                <tr>
                    <td>Time Out (2)</td>
                    <td>----------</td>
                </tr>
                <tr>
                    <td>Time In (3)</td>
                    <td>----------</td>
                </tr>
                <tr>
                    <td>Time Out (3)</td>
                    <td>----------</td>
                </tr>
            </div>
            </table>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#time").addClass('active');
    });
</script>
@endsection