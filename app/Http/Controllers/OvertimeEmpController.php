<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OvertimeEmp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OvertimeEmpController extends Controller
{
    /*
        Displays all overtime records in database
    */
    public function show_overtime_requests(){
        $overtimeRequests = DB::table('overtime_emp')
                              ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                              ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                              ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                              ->where('overtime_emp.emp_ID', '=', Auth::user()->id)
                              ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                              ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                              ->get();

        return view('employee.overtime-request', compact('overtimeRequests'));
    }

    /*
        Stores a new overtime request in database
    */
    public function add_overtime_request(Request $request){
        /* validate all fields */
        $request->validate([
            'date'        => 'required',
            'start_time'  => 'required',
            'end_time'    => 'required',
            'reason'      => 'required'
        ]);

        /* create an entry in the comments table and get id */
        $comment_ID = DB::table('comments')
                        ->insertGetId([
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        ]);

        /* insert data to database */
        DB::table('overtime_emp')
          ->insert([
              'emp_ID'      => Auth::user()->id,
              'date'        => $request->date,
              'start_time'  => $request->start_time,
              'end_time'    => $request->end_time,
              'reason'      => $request->reason,
              'comment_ID'  => $comment_ID,
              'status1'     => 'PENDING',
              'status2'     => 'PENDING',
              'created_at'  => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s')
          ]);

        return redirect('/overtime-request')->with('success', 'Overtime request added successfully');
    }

    /*
        Shows the form for editing the overtime request in database
    */
    public function edit_overtime_request($id){
        $overtimeRequests = DB::table('overtime_emp')
                              ->select('*')
                              ->where('id', '=', $id)
                              ->get()->first();

        return view('employee.overtime-request-edit', compact('overtimeRequests'));
    }

    /*
        Updates an overtime request in database
    */
    public function update_overtime_request(Request $request){
        /* validate all fields */
        $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'reason' => 'required'
        ]);

        /* update data */
        DB::table('overtime_emp')->where('id', '=', $request->id)
                ->update([
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'reason' => $request->reason,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

        return redirect('/overtime-request')->with('success', 'Overtime request updated successfully');
    }

    /*
        Delete an overtime record in database
    */
    public function delete_overtime_request(Request $request){
        /* delete data */
        DB::table('overtime_emp')->where('id', '=', $request->id)
                ->delete();

        return redirect('/overtime-request')->with('success', 'Overtime request deleted successfully');
    }
}
