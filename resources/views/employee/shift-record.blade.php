@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Shifts 
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Records
    </h6>

    <hr>

    <!-- Success Message -->
    @if ($message = Session::get('success'))
        <ul class="list-group mb-3">
            <li class="list-group-item list-group-item-success">{{ $message }}</li>
        </ul>
    @endif

    <!-- Error Message -->
    @if ($message = Session::get('error'))
        <ul class="list-group mb-3">
            <li class="list-group-item list-group-item-danger">{{ $message }}</li>
        </ul>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger mb-3">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Get data from shift_emp table --> 

    <!--Form Date Filter-->
    <form method="POST" action="/shift-records-search">
        @csrf 
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="date" name="end_date" class="form-control">
            </div>
            <!--For Management Only-->
            @if(Auth::user()->role == 'Management')
            <div class="col-sm mb-3">
                <label>Employee: </label>
                <input type="text" class="form-control" name="name">
            </div>
            @endif
            <div class="col-sm-1 mt-4">
                <button type="submit" class="form-control btn bg-info">Search</button>
            </div>
        </div>
    </form>

    <!--Shift Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Date Filed</th>
                        <!--Name shown only for management-->
                        @if(Auth::user()->role == 'Management')
                        <th scope="col">Name</th>
                        @endif
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Shift</th>
                        <th scope="col">Schedule</th>
                    </tr>
                </thead>

                <tbody>
                @if($requests->count() > 0)
                    @foreach($requests as $req)
                    <tr>
                        <!--Name shown only for management-->
                        <td>{{ date('Y/m/d', strtotime($req->created_at)) }}</td>
                        @if(Auth::user()->role == 'Management')
                        <td>{{ $req->first_name }} {{ $req->last_name }}</td>
                        @endif
                        <td>{{ date('Y/m/d', strtotime($req->start_date)) }}</td>
                        <td> {{ date('Y/m/d', strtotime($req->end_date)) }}</td>
                        <td>{{ $req->shift_name }}</td>
                        <td>{{ date('h:i A', strtotime($req->start_time))  }} <br> {{ date('h:i A', strtotime($req->end_time))  }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No change shift records yet!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#shift").addClass('active');
    });

    $('input[name="start_date"]').change(function() {
        $('input[name="end_date"]').attr("min", $('input[name="start_date"]').val());
    });
</script>
@endsection