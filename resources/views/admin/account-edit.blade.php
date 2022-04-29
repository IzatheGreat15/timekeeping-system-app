@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Update data from employee table -->

    <h2>Edit an Account</h2>

    <hr>

    <!-- Values populated from the database -->

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group mb-3">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Form -->
    <form class="mt-5" method="POST" action="/account-update">
        @csrf 
        <!-- Employee ID -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <input type="hidden" name="id" class="form-control" value="{{ $acc->id}}" id="userid">
            </div>
        </div>

        <!-- Employee Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>First Name: </label>
                <input type="text" name="first_name" class="form-control" value="{{ $acc->first_name }}" required>
            </div>
            <div class="col-sm mb-3">
                <label>Last Name: </label>
                <input type="text" name="last_name" class="form-control" value="{{ $acc->last_name }}" required>
            </div>
        </div>

        <!-- Email -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Email: </label>
                <input type="text" name="email" class="form-control" value="{{ $acc->email }}" required>
            </div>
        </div>

        <!-- Position and Role -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Position: </label>
                <input type="text" name="position" class="form-control" value="{{ $acc->position }}" required>
            </div>
            <div class="col-sm mb-3">
                <label>Role: </label>
                <select class="form-control" name="role" id="role" required>
                    <option {{ $acc->role == "Employee"? 'selected' : '' }}>Employee</option>
                    <option {{ $acc->role == "Management"? 'selected' : '' }}>Management</option>
                    <option {{ $acc->role == "Administrator"? 'selected' : '' }}>Administrator</option>
                </select>
            </div>
        </div>

        <!-- Department -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Department: </label>
                <!-- Department from the database -->
                <select class="form-control" name="dept_ID" required>
                    @foreach($depts as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Option whether to allow employee have a substitute -->
        <div class="form-row" id="substitute" style="display: none;">
            <div class="col-sm mb-3 form-inline">
                <label> Require Substitute? </label>
                <select class="form-control" id="req_sub">
                    <option {{ $acc->sub_ID != $acc->id ? 'selected' : '' }}>YES</option>
                    <option {{ $acc->sub_ID == $acc->id ? 'selected' : '' }}>NO</option>
                </select>
            </div>
        </div>

        <!-- Substitute - show only if the position is Manager/Supervisor -->
        <div class="form-row" id="sub" style="display: none;"> 
            <div class="col-sm mb-3 sub_dd">
                <label>Substitute: </label>
                <input type="hidden" value="{{ $acc->sub_ID }}" id="subID">

                <!-- Choose another manager/supervisor(same level) from database -->
                <select class="form-control" name="sub_ID" id="select_sub" required>
                    <option value="{{ $acc->id }}" {{ $acc->sub_ID == $acc->id? 'selected' : '' }}>-- Please select a substitute --</option>
                </select>
            </div>
        </div>

        <!-- Option whether to allow employee have a immediate superior -->
        <div class="form-row mt-3">
            <div class="col-sm mb-3 form-inline">
                <label> Require Immediate Superior? </label>
                <select class="form-control" id="req_sup">
                    <option {{ $acc->approval1_ID != $acc->id ? 'selected' : '' }}>YES</option>
                    <option {{ $acc->approval1_ID == $acc->id ? 'selected' : '' }}>NO</option>
                </select>
            </div>
        </div>

        <!-- Direct Managers/Supervisors -->
        <div class="form-row" id="sup" style="display: none;">
            <div class="col-sm mb-3">
                <label>Direct Managers/Supervisors: </label>
                <input type="hidden" value="{{ $acc->approval1_ID }}" id="approvalID">

                <!-- Choose a manager/supervisor(same department) from database -->
                <select class="form-control" name="approval_ID" id="select_sup" required>
                    <option value="{{ $acc->id }}" {{ $acc->approval1_ID == $acc->id? 'selected' : '' }}>-- Please select an immediate superior --</option>
                </select>
            </div>
        </div>

        <!-- Status -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Status: </label>
                <select class="form-control mt-2" name="status">
                    <option>ACTIVE</option>
                    <option>INACTIVE</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/accounts" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
    
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#admin").addClass('active');

        show_substitute();
        show_req_substitute();
        show_req_superior();
        dynamic_dropdown();
    });

    $("#role").change(function() {
        show_substitute();
    });

    /* for the display of substitute */
    $("#req_sub").change(function() {
        show_req_substitute();
    });

    /* for the display of immediate superior */
    $("#req_sup").change(function() {
        show_req_superior();
    });

    /* dynamic dropdown */
    $('select[name="dept_ID"]').on('change', function() {
        dynamic_dropdown();
    });

    function show_req_substitute(){
        var value = $("#req_sub").val();

        if(value == "YES"){
            $("#sub").show();
        } else {
            $("#select_sub").val($("#select_sub option:first").val());
            $("#sub").hide();
        }
    }

    function show_req_superior(){
        var value = $("#req_sup").val();

        if(value == "YES"){
            $("#sup").show();
        } else {
            $("#select_sup").val($("#select_sup option:first").val());
            $("#sup").hide();
        }
    }

    function show_substitute(){
        var value = $("#role").val();

        if(value == "Management"){
            $("#substitute").show();
        } else {
            $("#select_sub").val($("#select_sub option:first").val());
            $("#req_sub").val($("#req_sub option:last").val());
            $("#substitute").hide();
            $("#sub").hide();
        }
    }

    function dynamic_dropdown(){
        var deptID = $('select[name="dept_ID"]').val();
        var approvalID = $('#approvalID').val();
        var subID = $('#subID').val();
        var userID = $('#userid').val();

       
        if(deptID){
            $.ajax({
                url: '/account/ajax',
                type: "GET",
                data: {'id' : deptID},
                success:function(data){
                    /* append data to substitute dropdown */
                    $('select[name="sub_ID"] option:not(:first)').remove();
                    for(var i=0;i<data.length;i++){
                        if(data[i].id != userID)
                            $('select[name="sub_ID"]').append('<option value="'+ data[i].id +'"'+ (subID == data[i].id? "selected" : "") +'>'+ data[i].first_name +' ' + data[i].last_name +'</option>');
                    }

                    /* append data to innediate superior dropdown */
                    $('select[name="approval_ID"] option:not(:first)').remove();
                    for(var i=0;i<data.length;i++){
                        if(data[i].id != userID)
                            $('select[name="approval_ID"]').append('<option value="'+ data[i].id +'"'+ (approvalID == data[i].id? "selected" : "") +'>'+ data[i].first_name +' ' + data[i].last_name +'</option>');
                    }
                }
            });
        }
    }
</script>
@endsection