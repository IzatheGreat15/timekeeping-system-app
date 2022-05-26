@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>New Change Shift Request</h2>

    <hr>

    <!-- Add data to change_shift_emp table --> 

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group mb-3">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    <!--Request Form-->
    <form method="POST" action="/shift-change-add">
        @csrf 
        <!--Assigned Shift - choose a shift to change-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Assigned Shift: </label>
                <select class="form-control" name="shift_emp_ID">
                    @foreach($assigned as $shift)
                    <option value="{{ $shift->id }}">{{ $shift->shift_name }} ( {{ date('h:i A', strtotime($shift->start_time))  }} - {{ date('h:i A', strtotime($shift->end_time))  }}) {{ date('Y/m/d', strtotime($shift->start_date)) }} - {{ date('Y/m/d', strtotime($shift->end_date)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--Shift Change-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Shift Change to: </label>
                <select class="form-control" name="shift_ID">
                    @foreach($shifts as $shift)
                        <option value="{{ $shift->id }}">{{ $shift->shift_name }} ( {{ date('h:i A', strtotime($shift->start_time))  }} - {{ date('h:i A', strtotime($shift->end_time))  }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--Reason-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Reason: </label>
                <textarea class="form-control" name="reason"></textarea>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/shift-change" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#shift").addClass('active');
    });
</script>
@endsection