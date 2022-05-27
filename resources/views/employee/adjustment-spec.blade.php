@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="/adjustment-records" style="color:white">
        Back </a>

    <!-- Get data from adjustment_emp table --> 
    
    <!-- Employee, Date and Day -->
    <h2>
        <div class="row">
            <div class="col-md mt-3">
                {{ $req->first_name }} {{ $req->last_name }}
            </div>
            <div class="col-md mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                </svg>
                {{ date('D M j,  Y', strtotime($req->date)) }}
            </div>
        </div>
    </h2>

    <!--Attendance Details-->
    <div class="row">
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50">Shift</td>
                        <td class="w-50 font-weight-bold">{{ date('h:i A', strtotime($shift->start_time))  }} - {{ date('h:i A', strtotime($shift->end_time))  }}</td>
                    <tr>
                    <tr>
                        <td class="w-50">Time In (1)</td>
                        <td class="w-50 font-weight-bold">
                        @if($att->time_in1 != NULL)
                            {{ date('h:i A', strtotime($att->time_in1))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (1)</td>
                        <td class="w-50 font-weight-bold">
                        @if($att->time_out1 != NULL)
                            {{ date('h:i A', strtotime($att->time_out1))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (2)</td>
                        <td class="w-50 font-weight-bold">
                        @if($att->time_in2 != NULL)
                            {{ date('h:i A', strtotime($att->time_in2))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (2)</td>
                        <td class="w-50 font-weight-bold">
                        @if($att->time_out2 != NULL)
                            {{ date('h:i A', strtotime($att->time_out2))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (3)</td>
                        <td class="w-50 font-weight-bold">
                        @if($att->time_in3 != NULL)
                            {{ date('h:i A', strtotime($att->time_in3))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (3)</td>
                        <td class="w-50 font-weight-bold">
                        @if($att->time_out3 != NULL)
                            {{ date('h:i A', strtotime($att->time_out3))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50" colspan="2">Request to change to:</td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (1)</td>
                        <td class="w-50 font-weight-bold">
                        @if($req->time_in1 != NULL)
                            {{ date('h:i A', strtotime($req->time_in1))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (1)</td>
                        <td class="w-50 font-weight-bold">
                        @if($req->time_out1 != NULL)
                            {{ date('h:i A', strtotime($req->time_out1))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (2)</td>
                        <td class="w-50 font-weight-bold">
                        @if($req->time_in2 != NULL)
                            {{ date('h:i A', strtotime($req->time_in2))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (2)</td>
                        <td class="w-50 font-weight-bold">
                        @if($req->time_out2 != NULL)
                            {{ date('h:i A', strtotime($req->time_out2))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time In (3)</td>
                        <td class="w-50 font-weight-bold">
                        @if($req->time_in3 != NULL)
                            {{ date('h:i A', strtotime($req->time_in3))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Time Out (3)</td>
                        <td class="w-50 font-weight-bold">
                        @if($req->time_out3 != NULL)
                            {{ date('h:i A', strtotime($req->time_out3))  }}
                        @else
                            ---------
                        @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Reason</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                            {{ $req->reason }}
                        </td>
                    </tr>
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
                            <!-- Datetime -->
                            ({{ $req->updated_at1 }})
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 1</td>
                        <td class="w-50 font-weight-bold font-italic">{{ $req->status1 }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Remarks</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                        {{ $req->comment1 }}
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
                            <!-- Datetime -->
                            ({{ $req->updated_at2 }})
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic">Status 2</td>
                        <td class="w-50 font-weight-bold font-italic">{{ $req->status2 }}</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-italic" colspan="2">Remarks</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                        {{ $req->comment2 }}
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
    });
</script>
@endsection