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
}
