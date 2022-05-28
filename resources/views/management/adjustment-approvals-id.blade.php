@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <a type="button" class="btn shadow-md bg-danger mb-3" href="/approve-adjustments" style="color:white">
        Back </a>

    <!-- Employee, Date and Day -->
    <h2>
        <div class="row">
            <div class="col-md mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                </svg>
                {{$emp->filer_fname.' '.$emp->filer_lname}}
            </div>
            <div class="col-md mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                </svg>
                {{date('M d, Y', strtotime($emp->issue_date))}}
            </div>
            <div class="col-md mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                </svg>
                {{date('D', strtotime($emp->issue_date))}}
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
                        <td class="w-50 font-weight-bold">{{date('g:i A', strtotime($emp->start_time))}} - {{date('g:i A', strtotime($emp->end_time))}}</td>
                    <tr>
                    <tr>
                        <td class="w-50">Total Hrs:</td>
                        @if(strtotime($emp->end_time)-strtotime($emp->start_time) > 0)<td class="w-50 font-weight-bold">{{(strtotime($emp->end_time)-strtotime($emp->old_start_time))/3600}}</td>
                        @else()<td class="w-50 font-weight-bold">{{24+(strtotime($emp->end_time)-strtotime($emp->start_time))/3600}}</td>
                        @endif()
                    <tr>
                    <tr>
                        <td class="w-50">Reg Hrs:</td>
                        @if(strtotime($emp->end_time)-strtotime($emp->start_time) > 0)<td class="w-50 font-weight-bold">{{(strtotime($emp->end_time)-strtotime($emp->old_start_time))/3600}}</td>
                        @else()<td class="w-50 font-weight-bold">{{24+(strtotime($emp->end_time)-strtotime($emp->start_time))/3600}}</td>
                        @endif()
                    <tr>
                    <tr>
                        <td class="w-50">MP Hrs:</td>
                        @if(strtotime($emp->end_time)-strtotime($emp->start_time) > 0)<td class="w-50 font-weight-bold">{{(strtotime($emp->end_time)-strtotime($emp->old_start_time))/3600}}</td>
                        @else()<td class="w-50 font-weight-bold">{{24+(strtotime($emp->end_time)-strtotime($emp->start_time))/3600}}</td>
                        @endif()
                    <tr>
                    <tr>
                        <td class="w-50">Tardy:</td>
                        <td class="w-50 font-weight-bold">0</td>
                    <tr>
                    <tr>
                        <td class="w-50">Absence:</td>
                        <td class="w-50 font-weight-bold">0</td>
                    <tr>
                    <tr>
                        <td class="w-50 font-italic">Supervisor/Manager</td>
                        <td class="w-50 font-weight-bold font-italic">{{$emp->ap1_fname.' '.$emp->ap1_lname}}</td>
                    <tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Reason</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                            {{$emp->reason}}
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
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->oti1))}}</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->nti1))}}</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (1)</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->oto1))}}</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->nto1))}}</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (2)</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->oti2))}}</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->nti2))}}</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (2)</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->oto2))}}</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->nto2))}}</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (3)</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->oti3))}}</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->nti3))}}</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (3)</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->oto3))}}</td>
                        <td class="w-50 font-weight-bold">{{date('g:iA', strtotime($emp->nto3))}}</td>
                    </tr>

                    <!--If NOT APPROVED-->
                    <tr>
                        <td class="w-50 font-italic">Status 1</td>
                        <td class="w-50 font-weight-bold font-italic" colspan="2"><center>{{$emp->status1}}</center></td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 2</td>
                        <td class="w-50 font-weight-bold font-italic" colspan="2"><center>{{$emp->status2}}</center></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                <tr>
                        <td class="w-50 font-italic">Postion of Approver 1</td>
                        <td class="w-50 font-weight-bold font-italic">{{$emp->ap1_fname.' '.$emp->ap1_lname}} (Datetime)</td>
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
                        <td class="w-50 font-weight-bold font-italic">{{$emp->ap2_fname.' '.$emp->ap2_lname}} (Datetime)</td>
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
        <form method="POST" action="/approve-attendance">
            @csrf
            <!-- adjustment_emp ID --> 
            <input value="{{$emp->id}}"type="text" style="display: none;" name="id"/>
            <input value="{{$emp->att_id}}"type="text" style="display: none;" name="att_id"/>
            <input value="{{$emp->new_id}}"type="text" style="display: none;" name="new_id"/>
            
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