<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChangeShiftEmpController extends Controller
{
    /*
        display all change shift requests
     */
    public function display_shift_records(){
        $requests = DB::table('shift_emp')
                   ->select('users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.*')
                   ->join('users', 'users.id', '=', 'shift_emp.emp_ID')
                   ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                   ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->where(function($query){
                        $query->where('shift_emp.emp_ID', '=', Auth::user()->id)
                            ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                            ->orWhere('approvals.approval2_ID', '=', Auth::user()->id);
                    })
                   ->get();
        return view('employee.shift-record', compact('requests'));         
    }

    /**
     * search for a shift record
     */
    public function search_shift_records(Request $request){
        /* validate all fields */
        $request->validate([
            'start_date'         => 'required',
            'end_date'           => 'required'
        ]);

        $requests = NULL;
        $info = $request->input('name');

        /* get search word from the database */
        /* make sure the search function is case insensitive; search in leave name, description, and balance */

        /* if there is a name */
        if(isset($request->name)){
            $requests = DB::table('shift_emp')
                        ->select('users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.*')
                        ->join('users', 'users.id', '=', 'shift_emp.emp_ID')
                        ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query) use ($info){
                            $query->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($info) . '%')
                            ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($info) . '%');
                        })
                        ->where(function($query) use ($request){
                            $query->whereBetween('shift_emp.start_date', [$request->start_date, $request->end_date])
                                  ->orWhereBetween('shift_emp.end_date', [$request->start_date, $request->end_date]);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        } else {
            $requests = DB::table('shift_emp')
                        ->select('users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.*')
                        ->join('users', 'users.id', '=', 'shift_emp.emp_ID')
                        ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query) use ($request){
                            $query->whereBetween('shift_emp.start_date', [$request->start_date, $request->end_date])
                                  ->orWhereBetween('shift_emp.end_date', [$request->start_date, $request->end_date]);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        }

        if(isset($requests->first()->id))
            return view('employee.shift-record', compact('requests'));
        else
            return redirect('/shift-records')->with('error', 'No shift found. Try Again');
    }

    /**
     * search for a change shift record
     */
    public function search_change_shift(Request $request){
        /* validate all fields */
        $request->validate([
            'start_date'         => 'required',
            'end_date'           => 'required'
        ]);

        $requests = NULL;
        $info = $request->input('name');

        /* get search word from the database */
        /* make sure the search function is case insensitive; search in leave name, description, and balance */

        /* if there is a name */
        if(isset($request->name) && $request->status == "ALL"){
            $requests = DB::table('change_shift_emp')
                        ->select('change_shift_emp.*', 'users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.start_date', 'shift_emp.end_date')
                        ->join('users', 'users.id', '=', 'change_shift_emp.emp_ID')
                        ->join('shift_emp', 'shift_emp.id', '=', 'shift_emp_ID')
                        ->join('shifts', 'shifts.id', '=', 'change_shift_emp.shift_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query) use ($info){
                            $query->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($info) . '%')
                            ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($info) . '%');
                        })
                        ->where(function($query) use ($request){
                            $query->whereBetween('change_shift_emp.start_date', [$request->start_date, $request->end_date])
                                  ->orWhereBetween('change_shift_emp.end_date', [$request->start_date, $request->end_date]);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        } else if (!isset($request->name) && $request->status != "ALL"){
            $requests = DB::table('change_shift_emp')
                        ->select('change_shift_emp.*', 'users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.start_date', 'shift_emp.end_date')
                        ->join('users', 'users.id', '=', 'change_shift_emp.emp_ID')
                        ->join('shift_emp', 'shift_emp.id', '=', 'shift_emp_ID')
                        ->join('shifts', 'shifts.id', '=', 'change_shift_emp.shift_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query) use ($request){
                            $query->whereBetween('change_shift_emp.start_date', [$request->start_date, $request->end_date])
                                  ->orWhereBetween('change_shift_emp.end_date', [$request->start_date, $request->end_date]);
                        })
                        ->where(function($query) use ($request){
                            $query->where('change_shift_emp.status1', '=', $request->status)
                            ->orWhere('change_shift_emp.status2', '=', $request->status);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        } elseif (isset($request->name) && $request->status != "ALL") {
            $requests = DB::table('change_shift_emp')
                        ->select('change_shift_emp.*', 'users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.start_date', 'shift_emp.end_date')
                        ->join('users', 'users.id', '=', 'change_shift_emp.emp_ID')
                        ->join('shift_emp', 'shift_emp.id', '=', 'shift_emp_ID')
                        ->join('shifts', 'shifts.id', '=', 'change_shift_emp.shift_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query) use ($info){
                            $query->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($info) . '%')
                            ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($info) . '%');
                        })
                        ->where(function($query) use ($request){
                            $query->where('change_shift_emp.status1', '=', $request->status)
                            ->orWhere('change_shift_emp.status2', '=', $request->status);
                        })
                        ->where(function($query) use ($request){
                            $query->whereBetween('change_shift_emp.start_date', [$request->start_date, $request->end_date])
                                  ->orWhereBetween('change_shift_emp.end_date', [$request->start_date, $request->end_date]);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        } else {
            $requests = DB::table('change_shift_emp')
                        ->select('change_shift_emp.*', 'users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.start_date', 'shift_emp.end_date')
                        ->join('users', 'users.id', '=', 'change_shift_emp.emp_ID')
                        ->join('shift_emp', 'shift_emp.id', '=', 'shift_emp_ID')
                        ->join('shifts', 'shifts.id', '=', 'change_shift_emp.shift_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query) use ($request){
                            $query->whereBetween('change_shift_emp.start_date', [$request->start_date, $request->end_date])
                                  ->orWhereBetween('change_shift_emp.end_date', [$request->start_date, $request->end_date]);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        }

        if(isset($requests->first()->id))
            return view('employee.shift-change', compact('requests'));  
        else
            return redirect('/shift-change')->with('error', 'No change shifts found. Try Again');
    }

    /*
        display all change shift requests
     */
    public function display_change_shift(){
        $requests = DB::table('change_shift_emp')
                   ->select('change_shift_emp.*', 'users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.start_date', 'shift_emp.end_date')
                   ->join('users', 'users.id', '=', 'change_shift_emp.emp_ID')
                   ->join('shift_emp', 'shift_emp.id', '=', 'shift_emp_ID')
                   ->join('shifts', 'shifts.id', '=', 'change_shift_emp.shift_ID')
                   ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                   ->where('change_shift_emp.emp_ID', '=', Auth::user()->id)
                   ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                   ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                   ->get();

        return view('employee.shift-change', compact('requests'));         
    }

    /*
        view a change shift requests
     */
    public function view_change_shift($id){
        $req = DB::table('change_shift_emp')
                   ->select('change_shift_emp.*', 'users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'shift_emp.start_date', 'shift_emp.end_date', 'shift_emp.shift_ID', 'comments.*')
                   ->join('users', 'users.id', '=', 'change_shift_emp.emp_ID')
                   ->join('shift_emp', 'shift_emp.id', '=', 'shift_emp_ID')
                   ->join('shifts', 'shifts.id', '=', 'change_shift_emp.shift_ID')
                   ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                   ->join('comments', 'comments.id', '=', 'change_shift_emp.comment_ID')
                   ->where('change_shift_emp.id', '=', $id)
                   ->get()->first();

        $approvals = DB::table('change_shift_emp')
                    ->select('users.*', 'approvals.*')
                    ->join('users', 'users.id', '=', 'change_shift_emp.emp_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->where('change_shift_emp.id', '=', $id)
                    ->get()->first();
        return view('employee.shift-change-spec', compact('req', 'approvals'));         
    }

    /*
        Show add form
     */
    public function new_change_shift(){
        $date = date("Y/m/d");
    
        $assigned = DB::table('shift_emp')
                    ->select('shift_emp.*', 'shifts.*')
                    ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                    ->where('shift_emp.emp_ID', '=', Auth::user()->id)
                    ->where('end_date', '>=', $date)
                    ->get();

        $shifts = DB::table('shifts')
                    ->select('*')
                    ->get();

        return view('employee.shift-change-new', compact('assigned', 'shifts'));
    }

    /*
        Add chnage shift request to database
     */
    public function add_change_shift(Request $request){
        /* validate all fields */
        $request->validate([
            'shift_emp_ID'       => 'required',
            'shift_ID'           => 'required',
            'reason'             => 'required|max:255',
        ]);

        /* create an entry in the comments table and get id */
        $comment_ID = DB::table('comments')
                      ->insertGetId([
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                      ]);

        /* insert data to database */
        DB::table('change_shift_emp')
        ->insert([
            'emp_ID'           => Auth::user()->id,
            'shift_emp_ID'     => $request->shift_emp_ID,
            'shift_ID'         => $request->shift_ID,
            'reason'           => $request->reason,
            'comment_ID'       => $comment_ID,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s')
        ]);

        return redirect('/shift-change')->with('success', 'Change shift request filed successfully');
    }

    /*
        Show edit form
     */
    public function edit_change_shift($id){
        $date = date("Y/m/d");
    
        $assigned = DB::table('shift_emp')
                    ->select('shift_emp.*', 'shifts.*')
                    ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                    ->where('shift_emp.emp_ID', '=', Auth::user()->id)
                    ->where('end_date', '>=', $date)
                    ->get();

        $shifts = DB::table('shifts')
                    ->select('*')
                    ->get();
        
        $req = DB::table('change_shift_emp')
                   ->select('*')
                   ->where('id', '=', $id)
                   ->get()->first();

        return view('employee.shift-change-edit', compact('assigned', 'shifts', 'req'));
    }

    /*
        update chnage shift request to database
     */
    public function update_change_shift(Request $request){
        /* validate all fields */
        $request->validate([
            'shift_emp_ID'       => 'required',
            'shift_ID'           => 'required',
            'reason'             => 'required|max:255',
        ]);

        /* insert data to database */
        DB::table('change_shift_emp')
        ->update([
            'shift_emp_ID'     => $request->shift_emp_ID,
            'shift_ID'         => $request->shift_ID,
            'reason'           => $request->reason,
            'updated_at'       => date('Y-m-d H:i:s')
        ]);

        return redirect('/shift-change')->with('success', 'Change shift request updated successfully');
    }

    /**
     * Soft delete a change shift request (change statuses to cancelled)
     */
    public function delete_change_shift(Request $request){
        DB::table('change_shift_emp')->where('id', '=', $request->id)
            ->update([
                'status1'   => "CANCELLED",
                'status2'   => "CANCELLED"
            ]);

        return redirect('/shift-change')->with('success', 'Leave request cancelled successfully');
    }
}
