@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Update data from main_leave table -->

    <h2>Edit a Category of Leave</h2>

    <hr>

    <!-- Values are populated from the database --> 
    
    <!-- Form -->
    <form class="mt-5" method="POST" action="/main-leave-update">
        @csrf 
        <!-- Category ID -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <input type="hidden" name="id" class="form-control" value="{{ $leave->id}}">
            </div>
        </div>

        <!-- Category Name -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Category Name: </label>
                <input type="text" name="leave_name" class="form-control" value="{{ $leave->leave_name }}">
            </div>
        </div>

        <!-- Description -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Description: </label>
                <textarea name="description" class="form-control">{{ $leave->description }}</textarea>
            </div>
        </div>

        <!-- Total Balance -->
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>Total Balance: </label>
                <input type="number" name="total_balance" min="1" class="form-control" value="{{ $leave->total_balance }}">
            </div>
        </div>

        <!-- Require Supporting Documents -->
        <div class="form-group row">
            <div class="col-sm-4">Require Supporting Documents? </div>
            <div class="col-sm-2">
                <div class="form-check">
                    <select class="form-control" name="req_doc">
                        <option value="YES" {{ ($leave->req_doc == "YES")? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ ($leave->req_doc == "NO")? 'selected' : '' }}>NO</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a type="button" class="btn shadow-md bg-danger" href="/leaves-category" style="color:white">
                Back </a>
            <button class="btn shadow-md">Submit</button>
        </div>
    </form>
    
</div>

<script type="text/javascript">

    $(document).ready(function () {
        if($("#check").val()=="YES"){
            $("#check_label").text("YES");
            $("#gridCheck").val("YES");
            $("#gridCheck").prop("checked", true);
        }

        $("#admin").addClass('active');

        $("#gridCheck").change(function() {
            if($(this).prop("checked") == true){
                $("#check_label").text("YES");
                $("#check").val("YES");
            }else{
                $("#check_label").text("NO");
                $("#gcheck").val("NO");
            }
        });
    });

    function checkbox(){
        //alert($("#gridCheck").val());

        
    }
</script>
@endsection