@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <a type="button" class="btn shadow-md bg-danger" href="/leave-records" style="color:white">
        Back </a>

    <br><br>

    <!-- Get data from leave_emp table --> 

    <!--Employee Name-->
    <h3>{{ $req->first_name}} {{ $req->last_name }}</h3>

    <hr>

    <!--Leave Details-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <td class="w-50">Leave</td>
                    @if($req->sub_leave_ID > 0)
                            <td class="w-50 font-weight-bold">
                                {{ 
                                    DB::table('sub_leaves')
                                       ->select('sub_leave_name')
                                       ->where('id', '=', $req->sub_leave_ID)
                                       ->get()->first()->sub_leave_name
                                }}
                            </td>

                        @else
                            <td class="w-50 font-weight-bold">{{ $req->main_leave_name }}</td>
                        @endif
                </tr>
                <tr>
                    <td class="w-50">From Date</td>
                    <td class="w-50 font-weight-bold">{{ date('Y/m/d', strtotime($req->start_date)) }}</td>
                </tr>
                <tr>
                    <td class="w-50">To Date</td>
                    <td class="w-50 font-weight-bold">{{ date('Y/m/d', strtotime($req->end_date)) }}</td>
                </tr>
                <tr>
                    <td class="w-50 font-italic" colspan="2">Reason</td>
                </tr>
                <tr>
                    <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                    {{ $req->reason }}
                    </td>
                </tr>
                <tr>
                    <td class="w-50">Supporting Documents</td>
                    <td class="w-50 font-weight-bold text-info">
                        <a href="public/supporting_docs/{{ Auth::user()->id }}"
                           download="{{ $req->document_file }}">
                            {{ $req->document_file }}
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
                            ({{ $req->updated_at1 }})</td>
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
                        <td class="w-50 font-italic">Postion of Approver 2</td>
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#leaves").addClass('active');
    });
</script>
@endsection