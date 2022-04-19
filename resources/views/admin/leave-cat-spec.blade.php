@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <a type="button" class="btn shadow-md bg-danger" href="/leaves-category" style="color:white">
        Back </a>

    <!-- Get data from main_leave table -->

    <br><br>

    <!-- Leave Category Name -->
    <h2>{{ $leave->leave_name }} Leave</h2>

    <hr>

    <!--Leave Category Details-->
    <div class="row">
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50" colspan="2">Description</td>
                    <tr>
                    <tr>
                        <td class="w-50 font-weight-bold font-italic text-justify" colspan="2">
                            {!! nl2br(e($leave->description)) !!}
                        </td>
                    <tr>
                    <tr>
                        <td class="w-50">Total Balance</td>
                        <td class="w-50 font-weight-bold">{{ $leave->total_balance }}</td>
                    <tr>
                    <tr>
                        <td class="w-50">Require Supporting Documents</td>
                        <td class="w-50 font-weight-bold font-italic">{{ $leave->req_doc }}</td>
                    <tr>
                </table>
            </div>
        </div>
        
        <!-- List of Subcategories -->
        <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 mx-2 col-md shadow">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td class="w-50">Subcategories</td>
                    </tr>
                    @if($sub_leaves->count() > 0)
                        @foreach($sub_leaves as $sub)
                        <tr>
                            <td class="w-50 font-weight-bold">{{ $sub->leave_name }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-50 font-weight-bold">None</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#admin").addClass('active');
    });
</script>
@endsection