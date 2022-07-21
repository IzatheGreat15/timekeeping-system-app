<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    /*
        displays all attendance
     */
    public function show_attendance(){
        $requests = DB::table('attendance')
                    ->select('attendance.*', 'attendance.created_at AS date', 'attendance.id AS ID', 'time_adjustments.*', 'shift_emp.*', 'shifts.*', 'users.*')
                    ->join('time_adjustments','time_adjustments.id','=','attendance.time_ID')
                    ->join('shift_emp', 'shift_emp.emp_ID','=','attendance.emp_ID')
                    ->join('shifts','shifts.id','=','shift_emp.shift_ID')
                    ->join('users','users.id','=','attendance.emp_ID')
                    ->join('approvals','approvals.id','=','users.approval_ID')
                    ->where('attendance.emp_ID','=', Auth::user()->id)
                    ->orWhere('approvals.approval1_ID','=', Auth::user()->id)
                    ->orWhere('approvals.approval2_ID','=', Auth::user()->id)
                    ->get();

        return view('employee.attendance-record', compact('requests'));
    }

    /**
     * Search or export attendance
     */
    public function search_export_attendance(Request $request){
        /* validate all fields */
        $valid = Validator::make($request->all(), [
            'start_date'         => 'required',
            'end_date'           => 'required'
        ]);

        if($valid->fails()){
            return redirect('/attendance-records')->withErrors($valid);
        }

        $requests = NULL;
        $info = $request->input('name');
        switch ($request->input('action')) {
            case 'search':
                /* if there is a name */
                if($request->has('name')){
                    $requests = DB::table('attendance')
                            ->select('attendance.*', 'attendance.created_at AS date', 'attendance.id AS ID', 'time_adjustments.*', 'shift_emp.*', 'shifts.*', 'users.*')
                            ->join('time_adjustments','time_adjustments.id','=','attendance.time_ID')
                            ->join('shift_emp', 'shift_emp.emp_ID','=','attendance.emp_ID')
                            ->join('shifts','shifts.id','=','shift_emp.shift_ID')
                            ->join('users','users.id','=','attendance.emp_ID')
                            ->join('approvals','approvals.id','=','users.approval_ID')
                            ->where(function($query) use ($info){
                                $query->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($info) . '%')
                                ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($info) . '%');
                            })
                            ->where(function ($query) use ($request){
                                $query->whereBetween('attendance.created_at', [$request->start_date, $request->end_date])
                                      ->orwhereDate('attendance.created_at', $request->start_date)
                                      ->orwhereDate('attendance.created_at', $request->end_date);
                            })
                            ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                            ->get();
                } else {
                    $requests = DB::table('attendance')
                            ->select('attendance.*', 'attendance.created_at AS date', 'attendance.id AS ID', 'time_adjustments.*', 'shift_emp.*', 'shifts.*', 'users.*')
                            ->join('time_adjustments','time_adjustments.id','=','attendance.time_ID')
                            ->join('shift_emp', 'shift_emp.emp_ID','=','attendance.emp_ID')
                            ->join('shifts','shifts.id','=','shift_emp.shift_ID')
                            ->join('users','users.id','=','attendance.emp_ID')
                            ->join('approvals','approvals.id','=','users.approval_ID')
                            ->where(function ($query) use ($request){
                                $query->whereBetween('attendance.created_at', [$request->start_date, $request->end_date])
                                      ->orwhereDate('attendance.created_at', $request->start_date)
                                      ->orwhereDate('attendance.created_at', $request->end_date);
                            })
                            ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                            ->get();
                }
                if(isset($requests->first()->id))
                    return view('employee.attendance-record', compact('requests'));
                else
                    return redirect('/attendance-records')->with('error', 'No attendance found. Try Again');
                break;
    
            case 'export':
                $dept = DB::table('departments')
                        ->select('dept_name')
                        ->where('id', '=', Auth::user()->dept_ID)
                        ->get()->first();
                $filename = $dept->dept_name."_".date("Y")."_".date("M d", strtotime($request->start_date))." - ".date("M d", strtotime($request->end_date)).".xlsx";
                            
                return Excel::download(new AttendanceExport($request->start_date, $request->end_date), $filename);
                break;
        }
    }

    /*
        view an attendance
     */
    public function view_attendance($id){
        $req = DB::table('attendance')
                    ->select('attendance.*', 'attendance.emp_ID AS empID', 'attendance.created_at AS date', 'attendance.id AS ID', 'time_adjustments.*', 'shift_emp.*', 'shifts.*', 'users.*')
                    ->join('time_adjustments','time_adjustments.id','=','attendance.time_ID')
                    ->join('shift_emp', 'shift_emp.emp_ID','=','attendance.emp_ID')
                    ->join('shifts','shifts.id','=','shift_emp.shift_ID')
                    ->join('users','users.id','=','attendance.emp_ID')
                    ->join('approvals','approvals.id','=','users.approval_ID')
                    ->where('attendance.id','=', $id)
                    ->get()->first();

        $approvals = DB::table('users')
                     ->select('approvals.*')
                     ->join('approvals', 'approvals.id', '=', 'approval_ID')
                     ->where('users.id', '=', $req->empID)
                     ->get()->first();

        $timein = strtotime($req->time_in3);
        $timeout = strtotime($req->time_out3);
        $diff = round(($timeout-$timein)/3600, 3);
echo $diff;
        

        $hours = strtok($diff, ".");
        $mins = strtok(" ");
        //$mins = ($mins[0] == "0")? $mins[1] : $mins;


        //return view('employee.attendance-spec', compact('req', 'approvals', 'hours', 'mins'));
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
