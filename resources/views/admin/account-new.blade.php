@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Add data to employee table -->

    <h2>Add an Account</h2>

    <hr>

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group mb-3">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Form -->
    <form class="mt-5" method="POST" action="/add-new-account">
        @csrf

        <!-- Employee Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Employee Number: </label>
                <input type="number" name="emp_ID" class="form-control" minlength="10" required>
            </div>
            <div class="col-sm mb-3">
                <label>First Name: </label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="col-sm mb-3">
                <label>Last Name: </label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
        </div>

        <!-- Email and Password -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Email: </label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-sm mb-3">
                <label>Password: </label>
                <div class="input-group">
                    <input type="password" name="password" id="newpass" class="form-control" required>
                    <!-- Eye icons -->
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="newsee" style="display: none;">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" id="newhide" viewBox="0 0 16 16">
                                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Position and Role -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Position: </label>
                <input type="text" name="position" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>Role: </label>
                <select name="role" class="form-control" id="role" required>
                    <option>Employee</option>
                    <option>Management</option>
                    <option>Administrator</option>
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
                    <option>YES</option>
                    <option selected>NO</option>
                </select>
            </div>
        </div>

        <!-- Substitute - show only if the position is Manager/Supervisor -->
        <div class="form-row" id="sub" style="display: none;"> 
            <div class="col-sm mb-3">
                <label>Substitute: </label>
                <!-- Choose another manager/supervisor(same level) from database -->
                <select name="sub_ID" class="form-control" id="select_sub">
                    <option value="NULL">-- Please select a substitute --</option>
                </select>
            </div>
        </div>

        <!-- Option whether to allow employee have a immediate superior -->
        <div class="form-row mt-3">
            <div class="col-sm mb-3 form-inline">
                <label> Require Immediate Superior? </label>
                <select class="form-control" id="req_sup">
                    <option>YES</option>
                    <option selected>NO</option>
                </select>
            </div>
        </div>

        <!-- Direct Managers/Supervisors -->
        <div class="form-row" id="sup" style="display: none;">
            <div class="col-sm mb-3">
                <label>Direct Managers/Supervisors: </label>
                <!-- Choose a manager/supervisor(same department) from database -->
                <select name="approval_ID" class="form-control" id="select_sup">
                    <option value="NULL">-- Please select an immediate superior --</option>
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

        dynamic_dropdown();
    });

    $("#role").change(function() {
        var value = $("#role").val();

        if(value == "Management"){
            $("#substitute").show();
        } else {
            $("#select_sub").val($("#select_sub option:first").val());
            $("#req_sub").val($("#req_sub option:last").val());
            $("#substitute").hide();
            $("#sub").hide();
        }
    });

    /* for the display of substitute */
    $("#req_sub").change(function() {
        var value = $("#req_sub").val();

        if(value == "YES"){
            $("#sub").show();
        } else {
            $("#select_sub").val($("#select_sub option:first").val());
            $("#sub").hide();
        }
    });

    /* for the display of immediate superior */
    $("#req_sup").change(function() {
        var value = $("#req_sup").val();

        if(value == "YES"){
            $("#sup").show();
        } else {
            $("#select_sup").val($("#select_sup option:first").val());
            $("#sup").hide();
        }
    });

    /* dynamic dropdown */
    $('select[name="dept_ID"]').on('change', function() {
        dynamic_dropdown();
    });

    function dynamic_dropdown(){
        var deptID = $('select[name="dept_ID"]').val();

        if(deptID){
            $.ajax({
                url: '/account/ajax',
                type: "GET",
                data: {'id' : deptID},
                success:function(data){
                    /* append data to substitute dropdown */
                    $('select[name="sub_ID"] option:not(:first)').remove();
                    for(var i=0;i<data.length;i++){
                        $('select[name="sub_ID"]').append('<option value="'+ data[i].id +'">'+ data[i].first_name +' ' + data[i].last_name +'</option>');
                    }

                    /* append data to innediate superior dropdown */
                    $('select[name="approval_ID"] option:not(:first)').remove();
                    for(var i=0;i<data.length;i++){
                        $('select[name="approval_ID"]').append('<option value="'+ data[i].id +'">'+ data[i].first_name +' ' + data[i].last_name +'</option>');
                    }
                }
            });
        }
    }

    /* toggle password (show-hide) */
    $( "#newsee" ).click(function() {
        $('#newsee').hide();
        $('#newhide').show();
        $('#newpass').attr('type', 'text');
    });
    $( "#newhide" ).click(function() {
        $('#newhide').hide();
        $('#newsee').show();
        $('#newpass').attr('type', 'password');
    });
</script>
@endsection