@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Overtimes 
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

    <!-- Get data from overtime_emp table - show only APPROVED overtimes--> 

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

    <!--Overtime Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center" id="dept_table">
                <thead>
                    <tr>
                        <th scope="col">Date Filed</th>
                        <!--Name shown only for management-->
                        @if(Auth::user()->role == 'Management')
                        <th scope="col">Name</th>
                        @endif
                        <th scope="col">Date</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">No. of Hrs</th>
                        <th scope="col">Reason</th>
                    </tr>
                </thead>

                <tbody>
                @if ($requests->count() > 0)
                    @foreach ($requests as $req)
                    <!--Each row can be clicked redirect to overtime-spec.blade.php-->
                    <tr onclick="window.location='/overtime-records/{{ $req->id }}';">
                        <!--Name shown only for management-->
                        <td>{{ date('Y/m/d', strtotime($req->created_at)) }}</td>
                        @if(Auth::user()->role == 'Management')
                        <th scope="col">{{ $req->first_name }} {{ $req->last_name }}</th>
                        @endif
                        <td>{{ date('Y/m/d', strtotime($req->date)) }}</td>
                        <td id="start_time{{ $loop->iteration }}">{{ date('h:i A', strtotime($req->start_time)) }}</td>
                        <td id="end_time{{ $loop->iteration }}">{{ date('h:i A', strtotime($req->end_time)) }}</td>
                        <td id="time_difference{{ $loop->iteration }}"></td>
                        <td>{{ Str::limit($req->reason, 10)}}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="10">No overtime records available yet!</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#overtimes").addClass('active');

        var x;
        for(x = 1; x < $('#dept_table tr').length; x++){
            var start_time = new Date("01/01/2007 " + $('#start_time' + x).text());
            var end_time = new Date("01/01/2007 " + $('#end_time' + x).text());

            var diff = (end_time - start_time) / 60000;

            var minutes = diff % 60;
            var hours = (diff - minutes) / 60;

            $('#time_difference' + x).text((start_time > end_time)? 24 + hours : hours);
        }
    });
</script>
@endsection