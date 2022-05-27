@extends('employee.navbar')

@section('content')
<!--Actual Content-->
<div class="container bg-light p-3 p-sm-5 mb-5 shadow-lg" style="color:#767070;">
    <h2>Manage Account</h2>
    <!--Change information of account-->
    <hr>

    <!-- Success Message -->
    @if ($message = Session::get('success'))
        <ul class="list-group mb-3">
            <li class="list-group-item list-group-item-success">{{ $message }}</li>
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
    
    <!-- Form -->
    <form class="mt-5" method="POST" action="/manage-account-auth">
        @csrf 
        <!--Name-->
        <div class="row mb-3">
            <div class="col-sm">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}"/>
            </div>
            <div class="col-sm">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"/>
            </div>
        </div>

        <!--Email and Status-->
        <div class="row mb-3">
            <div class="col-sm">
                <label>Email Address</label>
                <input type="text" class="form-control" name="email" value="{{ $user->email }}"/>
            </div>
            <div class="col-sm">
                <label>Status</label>
                <input type="text" class="form-control" value="{{ $user->status }}" readonly/>
            </div>
        </div>

        <!--Department and Position-->
        <div class="row mb-3">
            <div class="col-sm">
                <label>Department</label>
                <input type="text" class="form-control" value="{{ $user->dept_name }}" readonly/>
            </div>
            <div class="col-sm">
                <label>Job Title</label>
                <input type="text" class="form-control" value="{{ $user->position }}" readonly/>
            </div>
        </div>

        <!-- Show ony if applicable -->

        <!-- Substitute -->
        <div class="row mb-3">
            <div class="col-sm">
                <label>Substitute</label>
                <input type="text" class="form-control" value="{{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $user->sub_ID)
                               ->get()->first()->first_name }} {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $user->sub_ID)
                               ->get()->first()->last_name }}" readonly/>
            </div>
        </div>

        <!-- Aprrovers -->

        <div class="row mb-2">
            <div class="col-sm">
                <label>Superiors</label>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm">
                <label>
                    {{ DB::table('users')
                            ->select('*')
                           ->where('id', '=', $user->approval1_ID)
                           ->get()->first()->position }} 
                </label>
                <input type="text" class="form-control" value="{{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $user->approval1_ID)
                               ->get()->first()->first_name }} {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $user->approval1_ID)
                               ->get()->first()->last_name }}" readonly/>
            </div>
            <div class="col-sm">
                <label>{{ DB::table('users')
                            ->select('*')
                           ->where('id', '=', $user->approval2_ID)
                           ->get()->first()->position }} 
                </label>
                <input type="text" class="form-control" value="{{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $user->approval2_ID)
                               ->get()->first()->first_name }} {{ DB::table('users')
                               ->select('*')
                               ->where('id', '=', $user->approval2_ID)
                               ->get()->first()->last_name }}" readonly/>
            </div>
        </div>

        <button type="submit" class="btn btn-block">Confirm</button>
    </form>
</div>
<script>
</script>
</div>

@endsection