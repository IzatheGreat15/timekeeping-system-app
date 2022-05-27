<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /*
        displays all attendance
     */
    public function show_attendance(){
        $requests = DB::table('attendance')
                    ->select('attendance.*', 'attendance.created_at AS date', 'attendance.id AS ID', 'time_adjustments.*', 'shift_emp.*', 'shifts.*', 'users.*')
                    ->join('time_adjustments','time_adjustments.id','=','attendance.time_ID')
                    ->join('shift_emp',function($join) {
                        $join->on('shift_emp.emp_ID','=','attendance.emp_ID')
                        ->on('shift_emp.start_date','<','attendance.created_at')
                        ->on('shift_emp.end_date','>=','attendance.created_at');
                    })
                    ->join('shifts','shifts.id','=','shift_emp.shift_ID')
                    ->join('users','users.id','=','attendance.emp_ID')
                    ->join('approvals','approvals.id','=','users.approval_ID')
                    ->where('attendance.emp_ID','=', Auth::user()->id)
                    ->orWhere('approvals.approval1_ID','=', Auth::user()->id)
                    ->orWhere('approvals.approval2_ID','=', Auth::user()->id)
                    ->get();

        return view('employee.attendance-record', compact('requests'));
    }

    /*
        view an attendance
     */
    public function view_attendance($id){
        $req = DB::table('attendance')
                    ->select('attendance.*', 'attendance.created_at AS date', 'attendance.id AS ID', 'time_adjustments.*', 'shift_emp.*', 'shifts.*', 'users.*')
                    ->join('time_adjustments','time_adjustments.id','=','attendance.time_ID')
                    ->join('shift_emp',function($join) {
                        $join->on('shift_emp.emp_ID','=','attendance.emp_ID')
                        ->on('shift_emp.start_date','<','attendance.created_at')
                        ->on('shift_emp.end_date','>=','attendance.created_at');
                    })
                    ->join('shifts','shifts.id','=','shift_emp.shift_ID')
                    ->join('users','users.id','=','attendance.emp_ID')
                    ->join('approvals','approvals.id','=','users.approval_ID')
                    ->where('attendance.id','=', $id)
                    ->get()->first();

        $approvals = DB::table('users')
                     ->select('approvals.*')
                     ->join('approvals', 'approvals.id', '=', 'approval_ID')
                     ->where('users.id', '=', $req->emp_ID)
                     ->get()->first();

        return view('employee.attendance-spec', compact('req', 'approvals'));
    }
}
