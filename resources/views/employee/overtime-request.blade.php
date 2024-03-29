@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h6>Overtimes
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dot" viewBox="0 -5 16 16">
            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
        Requests
    </h6>

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

    <!-- Error Messages -->
    @if ($errors->any())
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger mb-3">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Get data from overtime_emp table -->

    <!--Redirect to adjustment-new.blade.php-->
    <a type="button" class="btn shadow-md mb-3" href="/overtime-request-new" style="color:white">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus-circle" viewBox="0 1 16 16" style="overflow: visible">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
    New Request </a>

    <!--Form Date Filter-->
    <form method="POST" action="/overtime-request-search">
        @csrf
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="date" name="end_date" class="form-control">
            </div>
            <!--For Management Only - Employee-->
            @if(Auth::user()->role == 'Management')
            <div class="col-sm mb-3">
                <label>Employee: </label>
                <input type="text" class="form-control" name="name">
            </div>
            @endif
            <div class="col-sm mb-3">
                <label>Status: </label>
                <select class="form-control" name="status">
                    <option>ALL</option>
                    <option>PENDING</option>
                    <option>SENT BACK</option>
                    <option>APPROVED</option>
                    <option>REJECTED</option>
                </select>
            </div>
            <div class="col-sm-1 mt-4">
                <button type="submit" class="form-control btn bg-info">Search</button>
            </div>
        </div>
    </form>

    <!--Overtime Records-->
    <div class="container bg-light p-1 p-sm-4 mb-3 mt-3 shadow">
        <div class="table-responsive">
            <table class="table table-hover text-center" id="dept_table">
                <thead>
                    <tr>
                        <th scope="col">Date Filed</th>
                        <!--Name shown only for management-->
                        @if(Auth::user()->role == 'Management')
                        <th scope="col">Name</th>
                        @endif
                        <th scope="col">Date</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">No. of Hrs</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Status 1</th>
                        <th scope="col">Status 2</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($requests->count() > 0)
                        @foreach ($requests as $or)
                        <tr>
                            <!-- Hide ID -->
                            <td style="display: none;">{{ $or->id }}</td>
                            <!--Name shown only for management-->
                            <td>{{ date('Y/m/d', strtotime($or->created_at)) }}</td>
                            @if(Auth::user()->role == 'Management')
                                <td>{{ $or->first_name }} {{ $or->last_name }}</td>
                            @endif
                            <td>{{ date('Y/m/d', strtotime($or->date)) }}</td>
                            <td id="start_time{{ $loop->iteration }}">{{ date('h:i A', strtotime($or->start_time)) }}</td>
                            <td id="end_time{{ $loop->iteration }}">{{ date('h:i A', strtotime($or->end_time)) }}</td>
                            <td id="time_difference{{ $loop->iteration }}"></td>
                            <td>{{ Str::limit($or->reason, 10)}}</td>
                            <td>{{ $or->status1 }}</td>
                            <td>{{ $or->status2 }}</td>
                            <!--If request is APPROVED and REJECTED or if request is not of the user, buttons are not shown-->
                            <td>
                            <a class="btn btn-clear p-0" href="/overtime-request/{{ $or->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </a>
                            &nbsp;
                            @if(($or->status1 == 'PENDING' || $or->status1 == 'SENT BACK' || $or->status1 == 'PENDING' || $or->status1 == 'SENT BACK') && $or->emp_ID == Auth::user()->id)
                            <a class="btn btn-clear p-0" href="/overtime-request-edit/{{ $or->id }}">
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
                            @endif
                        </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="10">No overtime requests available yet!</td>
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

            <form method="POST" action="/overtime-request-deleted">
                @csrf
                <input id="dept_id" name="id" style="display: none;" />
                <p>Are you sure you want to delete?</p>
                    <button type="submit" class="btn bg-success">YES</button>
                    <button type="button" class="btn bg-danger" data-dismiss="modal" aria-label="Close">NO</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#overtimes").addClass('active');

        $("#dept_table").on('click', '.delete', function(){
            var currRow = $(this).closest("tr");
            var id = currRow.find('td:eq(0)').text();
            $("#dept_id").val(id);
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
