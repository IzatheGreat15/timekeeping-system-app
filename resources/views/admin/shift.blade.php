@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">

    <!-- Get data from shift table -->

    <h2>Shifts</h2>

    <hr>

    <!-- Success Message -->
    @if ($message = Session::get('success'))
        <ul class="list-group mb-3">
            <li class="list-group-item list-group-item-success">{{ $message }}</li>
        </ul>
    @endif

    <!-- Error Message -->
    @if ($message = Session::get('error'))
        <ul class="list-group mb-3">
            <li class="list-group-item list-group-item-danger">{{ $message }}</li>
        </ul>
    @endif

    <!-- Form Search -->
    <form method="POST" action="/shift-search">
        @csrf 
        <div class="form-row">
            <div class="col-sm mb-3">
                <!--Redirect to department-new.blade.php-->
                <a type="button" class="btn shadow-md mb-4" href="/shift-new" style="color:white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-plus-circle" viewBox="0 1 16 16" style="overflow: visible">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                Add </a>
            </div>

            <div class="col-sm mb-3">
            </div>

            <div class="col-md mb-3">
                <label>Search</label>
                <input type="text" name="shift_info" class="form-control">
            </div>
        </div>
    </form>

    <!--Shift Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-5 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center" id="dept_table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Shift Name</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">No. of Hrs</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($shifts->count() > 0)
                        @foreach ($shifts as $shift)
                        <tr>
                            <td style="display: none;">{{ $shift->id }}</td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shift->shift_name }}</td>
                            <td id="start_time{{ $loop->iteration }}">{{ date('h:i A', strtotime($shift->start_time)) }}</td>
                            <td id="end_time{{ $loop->iteration }}">{{ date('h:i A', strtotime($shift->end_time)) }}</td>
                            <td id="time_difference{{ $loop->iteration }}"></td>
                            <td>
                                <a class="btn btn-clear p-0" href="/shift-edit/{{ $shift->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                &nbsp;
                                <a class="btn btn-clear p-0 delete" data-toggle="modal" data-target=".delete-modal-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">No shifts available yet!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade delete-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 text-center">
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col">
                    <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
                
            <form method="POST" action="/shift-delete">
                @csrf 
                <input id="dept_id" name="id" style="display: none;" />
                <p>Are you sure you want to delete 
                    <br>
                    <strong id="dept_name"></strong> Shift?</p>
                    <button type="submit" class="btn bg-success">YES</button>
                    <button type="button" class="btn bg-danger" data-dismiss="modal" aria-label="Close">NO</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#admin").addClass('active');

        $("#dept_table").on('click', '.delete', function(){       
            var currRow = $(this).closest("tr");
            var id = currRow.find('td:eq(0)').text();
            var name = currRow.find('td:eq(2)').text();
            $("#dept_id").val(id);
            $("#dept_name").text(name);
        });

        var x;
        for(x = 1; x < $('#dept_table tr').length; x++){
            var start_time = new Date("01/01/2007 " + $('#start_time' + x).text());
            var end_time = new Date("01/01/2007 " + $('#end_time' + x).text());

            var diff = (end_time - start_time) / 60000;

            var minutes = diff % 60;
            var hours = (diff - minutes) / 60;

            $('#time_difference' + x).text((start_time > end_time)? 24 + hours : hours);
        }
    });
</script>
@endsection