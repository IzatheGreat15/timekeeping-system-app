@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <a type="button" class="btn shadow-md bg-danger" href="/leaves-category" style="color:white">
        Back </a>

    <br><br>

    <!-- Leave Category Name -->
    <h2>Vacation Leave</h2>

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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </td>
                    <tr>
                    <tr>
                        <td class="w-50">Total Balance</td>
                        <td class="w-50 font-weight-bold">13</td>
                    <tr>
                    <tr>
                        <td class="w-50">Require Supporting Documents</td>
                        <td class="w-50 font-weight-bold font-italic">YES/NO</td>
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
                    <tr>
                        <td class="w-50 font-weight-bold">Subcategory 1</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold">Subcategory 2</td>
                    </tr>
                    <tr>
                        <td class="w-50 font-weight-bold">Subcategory 3</td>
                    </tr>
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