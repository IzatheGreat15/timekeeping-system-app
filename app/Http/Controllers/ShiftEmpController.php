<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShiftEmpController extends Controller
{
    /**
     * Show all assigned shifts
     */
    public function show_manage_shift(){
        /* get the department of the logged in user */
        $curr = Auth::user();
        $dept = DB::table('users')->select('departments.dept_name')
                ->join('departments', 'departments.id', '=', 'users.dept_id')
                ->where('users.id', '=', $curr->id)->get()->first();

        $shifts = DB::table('shift_emp')
                  ->select('shift_emp.*', 'users.first_name', 'users.last_name', 'departments.dept_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time')
                  ->join('users', 'users.id', '=', 'shift_emp.emp_ID')
                  ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                  ->join('departments', 'departments.id', '=', 'dept_ID')
                  ->get();

        return view('management.manage-shift', compact('dept', 'shifts'));
    }

    /**
     * View a specific assigned shift to an employee
     */
    public function view_manage_shift($id){
        $shift = DB::table('shift_emp')
                ->select('shift_emp.*', 'users.first_name', 'users.last_name', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time')
                ->join('users', 'users.id', '=', 'shift_emp.emp_ID')
                ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                ->where('shift_emp.id', '=', $id)
                ->get()->first();

        $supervisor = DB::table('users')
                      ->select('*')
                      ->where('id', '=', $shift->emp_ID)
                      ->get()->first();

        return view('management.shift-manage-id', compact('shift', 'supervisor'));
    }

    /**
     * Show new manage shift form
     */
    public function new_manage_shift(){
        /* get all employees under the logged in user */
        $employees = DB::table('users')
                     ->select('users.*')
                     ->join('approvals', 'approvals.id', '=', 'approval_ID')
                     ->where('users.id', '=', Auth::user()->id)
                     ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                     ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                     ->get();

        /* get all available shifts */
        $shifts = DB::table('shifts')
                  ->select('*')
                  ->get();

        return view('management.manage-shift-new', compact('employees', 'shifts'));
    }

    /**
     * Add an assigned shift to database
     */
    public function add_manage_shift(Request $request){
        /* validate all fields */
        $request->validate([
            'start_date'       => 'required',
            'end_date'         => 'required',
            'emp_ID'           => 'required',
            'shift_ID'         => 'required'
        ]);

        /* insert data to database */
        DB::table("shift_emp")
        ->insert([
            'start_date'       => $request->start_date,
            'end_date'         => $request->end_date,
            'emp_ID'           => $request->emp_ID,
            'shift_ID'         => $request->shift_ID,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ]);

        return redirect('/manage-shifts')->with('success', 'Shift assigned successfully');
    }

    /**
     * Show edit manage shift form
     */
    public function edit_manage_shift($id){
        /* get all employees under the logged in user */
        $employees = DB::table('users')
                     ->select('users.*')
                     ->join('approvals', 'approvals.id', '=', 'approval_ID')
                     ->where('users.id', '=', Auth::user()->id)
                     ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                     ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                     ->get();

        /* get all available shifts */
        $shifts = DB::table('shifts')
                  ->select('*')
                  ->get();

        /* get the assigned shift to be edited */
        $assigned = DB::table('shift_emp')
                    ->select('*')
                    ->where('id', '=', $id)
                    ->get()->first();

        return view('management.manage-shift-edit', compact('employees', 'shifts', 'assigned'));
    }

    /**
     * Update an assigned shift to database
     */
    public function update_manage_shift(Request $request){
        /* validate all fields */
        $request->validate([
            'start_date'       => 'required',
            'end_date'         => 'required',
            'emp_ID'           => 'required',
            'shift_ID'         => 'required'
        ]);

        /* update data to database */
        DB::table("shift_emp")->where('id', '=', $request->id)
        ->update([
            'start_date'       => $request->start_date,
            'end_date'         => $request->end_date,
            'emp_ID'           => $request->emp_ID,
            'shift_ID'         => $request->shift_ID,
            'updated_at'       => date('Y-m-d H:i:s'),
        ]);

        return redirect('/manage-shifts')->with('success', 'Shift edited successfully');
    }

    /**
     * Delete an assigned shift to database
     */
    public function delete_manage_shift(Request $request){
        /* delete data */
        DB::table('shift_emp')->where('id', '=', $request->id)
            ->delete();

        return redirect('/manage-shifts')->with('success', 'Shift deleted successfully');
    }
}
