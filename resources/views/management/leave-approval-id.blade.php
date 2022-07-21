@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <a type="button" class="btn shadow-md bg-danger mb-3" href="/approve-leaves" style="color:white">
        Back </a>

    
    <!-- Get data from leave_emp table --> 

    <!--Employee Name-->
    <h3>John Doe</h3>

    <hr>

    <!--Leave Details-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <td class="w-50">Leave</td>
                    <td class="w-50 font-weight-bold">{{$emp->main_leave_name}}</td>
                </tr>
                <tr>
                    <td class="w-50">From Date</td>
                    <td class="w-50 font-weight-bold">{{date('M d, Y', strtotime($emp->start_date))}}</td>
                </tr>
                <tr>
                    <td class="w-50">To Date</td>
                    <td class="w-50 font-weight-bold">{{date('M d, Y', strtotime($emp->end_date))}}</td>
                </tr>
                <tr>
                    <td class="w-50 font-italic" colspan="2">Reason</td>
                </tr>
                <tr>
                    <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                    {{$emp->reason}}
                    </td>
                </tr>
                <tr>
                    <td class="w-50">Supporting Documents</td>
                    <td class="w-50 font-weight-bold">
                        <a href="/download/{{ $emp->document_file }}/{{ $emp->emp_ID }}"
                        target="_blank">
                            {{ $emp->document_file }}
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                <tr>
                        <td class="w-50 font-italic">Postion of Approver 1</td>
                        <td class="w-50 font-weight-bold font-italic">{{$emp->ap1_fname.' '.$emp->ap1_lname}} ({{ $emp->updated_at1 }})</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 1</td>
                        <td class="w-50 font-weight-bold font-italic">{{$emp->status1}}</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Remarks</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                            {{$emp->comment1}}
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Postion of Approver 2</td>
                        <td class="w-50 font-weight-bold font-italic">{{$emp->ap2_fname.' '.$emp->ap2_lname}} ({{ $emp->updated_at2 }})</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 2</td>
                        <td class="w-50 font-weight-bold font-italic">{{$emp->status2}}</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Remarks</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                        {{$emp->comment2}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>


    <!--Management Form-->
    @if(($emp->status2 == "PENDING" || $emp->status1 == "PENDING") && $emp->status2 != "REJECTED" && $emp->status1 != "REJECTED")
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 col-md shadow">
        <!-- Form -->
        <form method="POST" action="/approve-leave">
            @csrf
            <!-- adjustment_emp ID --> 
            <input value="{{$emp->id}}"type="text" style="display: none;" name="id"/>
            
            <div class="form-row mb-4">
                <div class="col-sm mb-3">
                    <label>Comment: </label>
                    <textarea class="form-control" name="managementComment"></textarea>
                </div>
            </div>
            <!--
                If Approved, replace the time_ID of the attendance with the time_ID of the adjustment
            -->
            <div class="form-row mb-4">
                <div class="col-sm mb-3">
                    <button class="btn shadow-md bg-danger" name="submit" value="-1">Reject</button>
                    <button class="btn shadow-md" name="submit" value="0">Send Back</button>
                    <button class="btn shadow-md bg-success" name="submit" value="1">Approve</button>
                </div>
            </div>
        </form>
    </div>
    @endif()
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#management").addClass('active');
    });
</script>
@endsection