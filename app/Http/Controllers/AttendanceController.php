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

    /*
        display in dashboard
     */
    public function display_dashboard(){
        $att = DB::table('attendance')
               -> select('time_adjustments.*', 'attendance.*', 'attendance.id AS ID')
               ->join('time_adjustments', 'time_adjustments.id', '=', 'attendance.time_ID')
               ->where('attendance.emp_ID', '=', Auth::user()->id)
               ->orderByDesc('attendance.created_at')
               ->get()->first();

        $status = "";
        if(($att->time_in1 != NULL & $att->time_out1 == NULL) | ($att->time_in2 != NULL & $att->time_out2 == NULL) | ($att->time_in3 != NULL & $att->time_out3 == NULL))
            $status = "time_out";
        elseif(($att->time_out1 != NULL & $att->time_in2 == NULL) | ($att->time_out2 != NULL & $att->time_in3 == NULL) | ($att->time_in1 != NULL)  | ($att->time_in1 == NULL & $att->time_out1 == NULL))
            $status = "time_in";

        if($att->time_in3 != NULL & $att->time_out3 != NULL)
            $status = "both";

        //echo ($att->time_in1 != NULL & $att->time_out1 == NULL) | ($att->time_in2 != NULL & $att->time_out2 == NULL) | ($att->time_in3 != NULL & $att->time_out3 == NULL) ;
        return view('employee.dashboard', compact('att', 'status'));
    }

    /*
        time in functionality
     */
    public function time_in($id){
        
        $att = DB::table('attendance')
               ->select('time_adjustments.*', 'attendance.time_ID')
               ->join('time_adjustments', 'time_adjustments.id', '=', 'attendance.time_ID')
               ->where('attendance.id', '=', $id)
               ->get()->first();

        date_default_timezone_set('Asia/Hong_Kong');
        $time = date('H:i:s');
        /* find a time in to update (1 - 3) */
        if($att->time_in1 == NULL){

            DB::table('time_adjustments')->where('id', '=', $att->time_ID)
            ->update([
                'time_in1'        => $time,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);

        } elseif($att->time_in2 == NULL){
            
            DB::table('time_adjustments')->where('id', '=', $att->time_ID)
            ->update([
                'time_in2'        => $time,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);
            
        } elseif($att->time_in3 == NULL){
            
            DB::table('time_adjustments')->where('id', '=', $att->time_ID)
            ->update([
                'time_in3'        => $time,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);
            
        }

        return redirect('/time-in-out');
    }

    /*
        time out functionality
     */
    public function time_out($id){
        
        $att = DB::table('attendance')
               ->select('time_adjustments.*', 'attendance.time_ID')
               ->join('time_adjustments', 'time_adjustments.id', '=', 'attendance.time_ID')
               ->where('attendance.id', '=', $id)
               ->get()->first();

        date_default_timezone_set('Asia/Hong_Kong');
        $time = date('H:i:s');
        /* find a time in to update (1 - 3) */
        if($att->time_out1 == NULL){

            DB::table('time_adjustments')->where('id', '=', $att->time_ID)
            ->update([
                'time_out1'       => $time,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);

        } elseif($att->time_out2 == NULL){
            
            DB::table('time_adjustments')->where('id', '=', $att->time_ID)
            ->update([
                'time_out2'       => $time,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);
            
        } elseif($att->time_out3 == NULL){
            
            DB::table('time_adjustments')->where('id', '=', $att->time_ID)
            ->update([
                'time_out3'       => $time,
                'updated_at'      => date('Y-m-d H:i:s')
            ]);
            
        }

        return redirect('/time-in-out');
    }
}
