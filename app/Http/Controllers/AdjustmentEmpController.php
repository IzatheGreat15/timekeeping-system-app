<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdjustmentEmp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdjustmentEmpController extends Controller
{
    /*
        Displays all adjustment requests
     */
    public function show_adjustment(){
        $requests = DB::table('adjustment_emp')
                    ->select('adjustment_emp.*', 'users.first_name', 'users.last_name', 'attendance.created_at AS date', 'time_adjustments.time_in1', 'time_adjustments.time_out1', 'time_adjustments.time_out2', 'time_adjustments.time_out3')
                    ->join('users', 'users.id', '=', 'adjustment_emp.emp_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->join('time_adjustments', 'time_adjustments.id', '=', 'adjustment_emp.time_ID')
                    ->join('attendance', 'attendance.id', '=', 'adjustment_emp.att_ID')
                    ->where('adjustment_emp.emp_ID', '=', Auth::user()->id)
                    ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                    ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                    ->get();

        return view('employee.adjustment-record', compact('requests'));
    }

    /*
        view an adjustment requests
     */
    public function view_adjustment($id){
        $req= DB::table('adjustment_emp')
                    ->select('adjustment_emp.*', 'users.first_name', 'users.last_name',
                    'attendance.created_at AS date', 'time_adjustments.time_in1', 
                    'time_adjustments.time_out1', 'time_adjustments.time_in2', 'time_adjustments.time_out2', 'time_adjustments.time_in3', 'time_adjustments.time_out3',
                    'comments.*')
                    ->join('users', 'users.id', '=', 'adjustment_emp.emp_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->join('time_adjustments', 'time_adjustments.id', '=', 'adjustment_emp.time_ID')
                    ->join('attendance', 'attendance.id', '=', 'adjustment_emp.att_ID')
                    ->join('comments', 'comment_id', '=', 'adjustment_emp.comment_ID')
                    ->where('adjustment_emp.id', '=', $id)
                    ->get()->first();

        /* get the shift of the user during the adjustment request */
        $shift = DB::table('shift_emp')
                 ->select('shift_emp.*', 'shifts.start_time', 'shifts.end_time')
                 ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                 ->where('shift_emp.emp_ID', '=', $req->emp_ID)
                 ->where('shift_emp.start_date', '<=', $req->date)
                 ->where('shift_emp.end_date', '>=', $req->date)
                 ->get()->first();
        
        $att = DB::table('attendance')
                 ->select('time_adjustments.*')
                 ->join('time_adjustments', 'time_adjustments.id', '=', 'attendance.time_ID')
                 ->where('attendance.id', '=', $req->att_ID)
                 ->get()->first();

        $approvals = DB::table('adjustment_emp')
                 ->select('users.*', 'approvals.*')
                 ->join('users', 'users.id', '=', 'adjustment_emp.emp_ID')
                 ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                 ->where('adjustment_emp.id', '=', $id)
                 ->get()->first();

        return view('employee.adjustment-spec', compact('req', 'shift', 'att', 'approvals'));
    }

    /*
        Stores a new shift in database
    */
    public function add_adjustment(Request $request){
        /* validate all fields */
        $request->validate([
            'date'         => 'required',
            'reason'       => 'required',
            'time_in1'     => 'required',
            'time_out1'    => 'required'
        ]);

        $att_ID = DB::table('attendance')
                  ->select('*')
                  ->where('emp_ID', '=', Auth::user()->id)
                  ->whereDate('created_at', '=', $request->date)
                  ->get()->first();
        
        /* If chosen date does not exist in the attendance record of the user */
        if(!isset($att_ID->id))
            return redirect('/adjustment-new')->with('error', 'Error! No attendance with the date selected exists.');

        /* create an entry in the comments table and get id */
        $comment_ID = DB::table('comments')
                      ->insertGetId([
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                      ]);

        /* create an entry in the comments table and get id */
        $time_ID = DB::table('time_adjustments')
                      ->insertGetId([
                        'time_in1'          => $request->time_in1,
                        'time_out1'          => $request->time_out1,
                        'time_in2'          => $request->time_in2,
                        'time_out2'          => $request->time_out2,
                        'time_in3'          => $request->time_in3,
                        'time_out3'          => $request->time_out3,
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                      ]);

        /* insert data to database */
        DB::table('adjustment_emp')
        ->insert([
            'emp_ID'          => Auth::user()->id,
            'time_ID'         => $time_ID,
            'att_ID'          => $att_ID->id,
            'reason'          => $request->reason,
            'comment_ID'      => $comment_ID,
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s')
        ]);
        
        return redirect('/adjustment-records')->with('success', 'Adjustment request filed successfully!');
    }

    /*
        show edit form
    */
    public function edit_adjustment($id){
        $req = DB::table('adjustment_emp')
               ->select('adjustment_emp.*', 'adjustment_emp.id AS ID', 'time_adjustments.*', 'attendance.created_at AS date')
               ->join('time_adjustments', 'time_adjustments.id', '=', 'adjustment_emp.time_ID')
               ->join('attendance', 'attendance.id', '=', 'adjustment_emp.att_ID')
               ->where('adjustment_emp.id', '=', $id)
               ->get()->first();
               
        return view('employee.adjustment-edit', compact('req'));
    }

    /*
        Soft delete a new shift in database
    */
    public function update_adjustment(Request $request){
        /* validate all fields */
        $request->validate([
            'date'         => 'required',
            'reason'       => 'required',
            'time_in1'     => 'required',
            'time_out1'    => 'required'
        ]);

        $att_ID = DB::table('attendance')
                  ->select('*')
                  ->where('emp_ID', '=', $request->emp_ID)
                  ->whereDate('created_at', '=', $request->date)
                  ->get()->first();
        
        /* If chosen date does not exist in the attendance record of the user */
        if(!isset($att_ID->id))
            return back()->with('error', 'Error! No attendance with the date selected exists.');

        DB::table('adjustment_emp')->where('id', '=', $request->id)
        ->update([
            'reason'       =>  $request->reason,
            'updated_at'   => date('Y-m-d H:i:s'),
            'att_ID'         => $att_ID->id
        ]);

        /* get the ID of time_ID*/
        $app = DB::table('adjustment_emp')
               ->select('*')
               ->where('id', '=', $request->id)
               ->get()->first();
        
        /* update time_adjustments */
        DB::table('time_adjustments')->where('id', '=', $app->time_ID)
        ->update([
            'time_in1'     => $request->time_in1,
            'time_out1'    => $request->time_out1,
            'time_in2'     => $request->time_in2,
            'time_out2'    => $request->time_out2,
            'time_in3'     => $request->time_in3,
            'time_out3'    => $request->time_out3,
        ]);

        return redirect('/adjustment-records')->with('success', 'Adjustment request updated successfully');
    }
    /*
        Soft delete an adjustment request in database
    */
    public function delete_adjustment(Request $request){
        DB::table('adjustment_emp')->where('id', '=', $request->id)
        ->update([
            'status1'         => "CANCELLED",
            'status2'         => "CANCELLED",
            'updated_at'      => date('Y-m-d H:i:s')
        ]);

        return redirect('/adjustment-records')->with('success', 'Adjustment request cancelled successfully');
    }
}

