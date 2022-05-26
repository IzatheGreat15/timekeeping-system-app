@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Edit Leave Request</h2>

    <hr>

    <!-- Update data from leave_emp table --> 

    <!--Value of all fields are populated from the database-->
    
    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group mb-3">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    <!-- Leave Balance -->
    <div class="row mb-3">
        @foreach($balance as $bal)
        <div class="col-md">
            <!-- If there are balance left -->
            @if($bal->balance > 0)
            <div class="container bg-light p-2 p-sm-4 mx-0 mb-3 shadow">
                <h5 class="font-weight-bold">{{ $bal->main_leave_name }}</h5> <br>
                <p>Balance {{ $bal->balance }} out of {{ $bal->total_balance }}</p>

                <!-- balance >= 75% -->
                @if( $bal->balance/$bal->total_balance*100 >= 75)
                <div class="progress">
                    <div class="progress-bar bg-success" style="width:{{ $bal->balance/$bal->total_balance*100 }}%;" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <!-- balance >= 50% -->
                @elseif( $bal->balance/$bal->total_balance*100 >= 50)
                <div class="progress">
                    <div class="progress-bar bg-warning" style="width:{{ $bal->balance/$bal->total_balance*100 }}%;" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <!-- balance <= 35% -->
                @elseif( $bal->balance/$bal->total_balance*100 <= 35)
                <div class="progress">
                    <div class="progress-bar bg-danger" style="width:{{ $bal->balance/$bal->total_balance*100 }}%;" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @endif
            </div>
            
            <!-- no more balance left - red bg color -->
            @else
            <div class="container bg-danger text-light p-2 p-sm-4 mx-0 mb-3 shadow">
                <h5 class="font-weight-bold">{{ $bal->main_leave_name }}</h5> <br>
                <p class="text-light">Balance {{ $bal->balance }} out of {{ $bal->total_balance }}</p>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width:0%;" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    
    <!--Request Form-->
    <form method="POST" enctype="multipart/form-data" action="/leave-request-update">
        @csrf 
        <p>Date</p>

        <!-- ID -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <input type="hidden" name="id" class="form-control" value="{{ $leave->id}}" required>
            </div>
        </div>

        <!--Date-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="date" class="form-control" value="{{ $leave->start_date }}" name="start_date" required>
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="date" class="form-control" value="{{ $leave->end_date }}" name="end_date" required>
            </div>
        </div>

        <!--Leave-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Leave: </label>
                <select class="form-control" id="leave" name="leave_ID" required>
                    <!-- Show only leaves with remaining balance -->

                    <!-- If sub leave is not initialiy chosen -->
                    @foreach($main as $m)
                        <option value="{{ $m->id }}" {{ $leave->main_leave_ID == $m->id? 'selected' : '' }} class="{{ $m->req_doc }}">{{ $m->main_leave_name }}</option>
                        {{ 
                            $sub = DB::table('sub_leaves')
                                ->select('*')
                                ->where('main_leave_ID', '=', $m->id)
                                ->get();
                        }}
                        @foreach($sub as $s)
                            <option value="{{ $s->id }}S" {{ $leave->sub_leave_ID == $s->id? 'selected' : '' }} class="{{ $m->req_doc }}">{{ $s->sub_leave_name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>

        <!--Supporting Document (Med Cert only for Sick Leaves)-->
        <div class="form-row mb-4" id="support_doc">
            <div class="col-sm mb-3">
                <label>Supporting Document: </label> <br>
                <input type="file" name="document_file">
                <a href="public/supporting_docs/{{ Auth::user()->id }}"
                           download="{{ $leave->document_file }}"
                           class="link-info">
                            {{ $leave->document_file }}
                </a>
            </div>
        </div>

        <!--Reason-->
        <div class="form-row mb-4">
            <div class="col-sm mb-3">
                <label>Reason: </label>
                <textarea class="form-control" name="reason" required> {{ $leave->reason }} </textarea>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/leave-request" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#leaves").addClass('active');

        toggle_support_doc();
    });

    $("#leave").change(function() {
        toggle_support_doc();
    });

    function toggle_support_doc(){
        var value = $('select[name="leave_ID"] :selected').attr('class');

        (value == "YES")? $('#support_doc').show() : $('#support_doc').hide();
    }
</script>
@endsection