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
        $requests = DB::table('overtime_emp')
                              ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                              ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                              ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                              ->where('overtime_emp.emp_ID', '=', Auth::user()->id)
                              ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                              ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                              ->get();

        return view('employee.overtime-request', compact('requests'));
    }

    /*
        Displays all overtime records in database - APPROVED
    */
    public function show_overtime_records(){
        $requests = DB::table('overtime_emp')
                   ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                   ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                   ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                   ->where(function($query){
                    $query->where('overtime_emp.status1', '=', 'APPROVED')
                          ->where('overtime_emp.status2', '=', 'APPROVED');
                    })
                    ->where(function($query){
                        $query->where('overtime_emp.emp_ID', '=', Auth::user()->id)
                            ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                            ->orWhere('approvals.approval2_ID', '=', Auth::user()->id);
                    })
                    ->get();

        return view('employee.overtime-records', compact('requests'));  
    }

    /**
     * search for a overtime record
     */
    public function search_overtime_record(Request $request){
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
            $requests = DB::table('overtime_emp')
                        ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                        ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query){
                        $query->where('overtime_emp.status1', '=', 'APPROVED')
                            ->where('overtime_emp.status2', '=', 'APPROVED');
                        })
                        ->where(function($query) use ($info){
                            $query->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($info) . '%')
                            ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($info) . '%');
                        })
                        ->where(function($query) use ($request){
                            $query->whereBetween('overtime_emp.start_date', [$request->start_date, $request->end_date])
                                  ->orWhereBetween('overtime_emp.end_date', [$request->start_date, $request->end_date]);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        } else {
            $requests = DB::table('overtime_emp')
                        ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                        ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query){
                        $query->where('overtime_emp.status1', '=', 'APPROVED')
                            ->where('overtime_emp.status2', '=', 'APPROVED');
                        })
                        ->where(function($query) use ($request){
                            $query->whereBetween('overtime_emp.start_date', [$request->start_date, $request->end_date])
                                  ->orWhereBetween('overtime_emp.end_date', [$request->start_date, $request->end_date]);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        }

        if(isset($requests->first()->id))
            return view('employee.overtime-records', compact('requests')); 
        else
            return redirect('/overtime-records')->with('error', 'No overtime found. Try Again');
    }

    /**
     * search for a overtime request
     */
    public function search_overtime_request(Request $request){
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
            $requests = DB::table('overtime_emp')
                        ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                        ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query) use ($info){
                            $query->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($info) . '%')
                            ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($info) . '%');
                        })
                        ->whereBetween('overtime_emp.created_at', [$request->start_date, $request->end_date])
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        } else if (!isset($request->name) && $request->status != "ALL"){
            $requests = DB::table('overtime_emp')
                        ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                        ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->whereBetween('overtime_emp.created_at', [$request->start_date, $request->end_date])
                        ->where(function($query) use ($request){
                            $query->where('overtime_emp.status1', '=', $request->status)
                            ->orWhere('overtime_emp.status2', '=', $request->status);
                        })
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        } elseif (isset($request->name) && $request->status != "ALL") {
            $requests = DB::table('overtime_emp')
                        ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                        ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where(function($query) use ($info){
                            $query->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($info) . '%')
                            ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($info) . '%');
                        })
                        ->where(function($query) use ($request){
                            $query->where('overtime_emp.status1', '=', $request->status)
                            ->orWhere('overtime_emp.status2', '=', $request->status);
                        })
                        ->whereBetween('overtime_emp.created_at', [$request->start_date, $request->end_date])
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        } else {
            $requests = DB::table('overtime_emp')
                        ->select('overtime_emp.*', 'users.first_name', 'users.last_name')
                        ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->whereBetween('overtime_emp.created_at', [$request->start_date, $request->end_date])
                        ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                        ->get();
        }

        if(isset($requests->first()->id))
            return view('employee.overtime-request', compact('requests')); 
        else
            return redirect('/overtime-request')->with('error', 'No overtime requests found. Try Again');
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
        view a specific overtime
    */
    public function view_overtime_request($id){
        $req = DB::table('overtime_emp')
                              ->select('overtime_emp.*', 'users.first_name', 'users.last_name', 'comments.*')
                              ->join('users', 'users.id', '=', 'overtime_emp.emp_ID') 
                              ->join('comments', 'comments.id', '=', 'overtime_emp.comment_ID')
                              ->where('overtime_emp.id', '=', $id)
                              ->get()->first();

        $approvals = DB::table('overtime_emp')
                    ->select('users.*', 'approvals.*')
                    ->join('users', 'users.id', '=', 'overtime_emp.emp_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->where('overtime_emp.id', '=', $id)
                    ->get()->first();
        return view('employee.overtime-spec', compact('req', 'approvals'));
    }

    /*
        Delete an overtime record in database
    */
    public function delete_overtime_request(Request $request){
        /* delete data */
        DB::table('overtime_emp')->where('id', '=', $request->id)
                ->update([
                    'status1'   => 'CANCELLED',
                    'status2'   => 'CANCELLED'
                ]);

        return redirect('/overtime-request')->with('success', 'Overtime request deleted successfully');
    }
}
