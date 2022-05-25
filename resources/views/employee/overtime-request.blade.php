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

    <!-- Get data from overtime_emp table -->

    <!--Redirect to adjustment-new.blade.php-->
    <a type="button" class="btn shadow-md mb-3" href="/overtime-request-new" style="color:white">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus-circle" viewBox="0 1 16 16" style="overflow: visible">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
    New Request </a>

    <!--Form Date Filter-->
    <form>
        <div class="form-row">
            <div class="col-sm mb-3">
                <label>From: </label>
                <input type="date" class="form-control">
            </div>
            <div class="col-sm mb-3">
                <label>To: </label>
                <input type="date" class="form-control">
            </div>
            <!--For Management Only - Employee-->
            <div class="col-sm mb-3">
                <label>Employee: </label>
                <input type="text" class="form-control" placeholder="John Doe">
            </div>
            <div class="col-sm mb-3">
                <label>Status: </label>
                <select class="form-control">
                    <option>ALL</option>
                    <option>PENDING</option>
                    <option>SENT BACK</option>
                    <option>APPROVED</option>
                    <option>REJECTED</option>
                </select>
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
                        <th scope="col">Name</th>
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
                    @if ($overtimeRequests->count() > 0)
                        @foreach ($overtimeRequests as $or)
                        <tr>
                            <!-- Hide ID -->
                            <td style="display: none;">{{ $or->id }}</td>
                            <!--Name shown only for management-->
                            <td>{{ date('Y/m/d', strtotime($or->created_at)) }}</td>
                            <td>{{ $or->first_name }} {{ $or->last_name }}</td>
                            <td>{{ $or->date }}</td>
                            <td>{{ $or->start_time }}</td>
                            <td>{{ $or->end_time }}</td>
                            <td>9</td>
                            <td>{{ $or->reason }}</td>
                            <td>APPROVED</td>
                            <td>REJECTED</td>
                            <!--If request is APPROVED and REJECTED or if request is not of the user, buttons are not shown-->
                            <td></td>
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

            <form>
                <input id="id" name="id" style="display: none;" />
                <p>Are you sure you want to delete?</p>
                    <button type="button" class="btn bg-success">YES</button>
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
    });
</script>
@endsection
