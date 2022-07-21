<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    function show_management_dash(){
        $curr = Auth::user();
        $dept = DB::table('users')->select('departments.dept_name')->join('departments', 'departments.id', '=', 'users.dept_id')->where('users.id', '=', $curr->id)->get()->first();

        $list = DB::table('users')
            ->select('users.id', 'users.first_name AS uFN', 'users.last_name AS uLN', 'users.created_at', 'users.position', 'shifts.shift_name', 'departments.dept_name', 'ap1.first_name AS a1FN', 'ap1.last_name AS a1LN', 'ap2.first_name AS a2FN', 'ap2.last_name AS a2LN', 'sub.first_name AS sFN', 'sub.last_name AS sLN', 'users.status')
            ->join('departments', 'departments.id', '=', 'users.dept_id')
            ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
            ->join('shift_Emp', 'shift_emp.emp_id', '=', 'users.id')
            ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_id')
            ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_ID')
            ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_ID')
            ->join('users AS sub', 'sub.id', '=', 'users.sub_ID')
            ->where('users.dept_id', '=', $curr->dept_ID)
            ->get();

            return View('management.dashboard', ['list' => $list, 'dept' => $dept]);
    }

    function show_management_emp_indiv($id){
        $curr = DB::table('users')
        ->select('users.first_name AS uFN', 'users.last_name AS uLN', 'users.email', 'users.position', 'users.created_at', 'shifts.shift_name', 'departments.dept_name', 'ap1.first_name AS a1FN', 'ap1.last_name AS a1LN', 'sub.first_name AS sFN', 'sub.last_name AS sLN', 'users.status')
        ->join('departments', 'departments.id', '=', 'users.dept_id')
        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
        ->join('shift_Emp', 'shift_emp.emp_id', '=', 'users.id')
        ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_ID')
        ->join('users AS sub', 'sub.id', '=', 'users.sub_ID')
        ->where('users.id', '=', $id)
        ->get()->first();

        return View('management.employee-spec', ['emp' => $curr]);
    }

    function show_management_attendance_adjustment(){
        $curr = Auth::user();
        $dept = DB::table('users')->select('departments.dept_name')->join('departments', 'departments.id', '=', 'users.dept_id')->where('users.id', '=', $curr->id)->get()->first();


        $list = DB::table('Adjustment_Emp')
        ->select('Adjustment_Emp.id','filer.first_name', 'filer.last_name', 'departments.dept_name', 'adjustment_emp.created_at AS file_date', 'attendance.created_at AS issue_date', 'old.time_in1', 'old.time_out3', 'adjustment_emp.reason', 'adjustment_emp.status1', 'adjustment_emp.status2',)
        ->join('users AS filer', 'filer.id', '=', 'adjustment_emp.emp_id')
        ->join('approvals', 'approvals.id', '=', 'filer.approval_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_id')
        ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_id')
        ->join('attendance', 'attendance.emp_id', '=', 'filer.id')
        ->join('time_adjustments AS old', 'old.id', '=', 'attendance.time_id')
        ->join('time_adjustments AS new', 'new.id', '=', 'adjustment_emp.time_id')
        ->join('departments', 'departments.id', 'filer.dept_id')
        ->where('ap1.id', '=', $curr->id)
        ->orwhere('ap2.id', '=', $curr->id)
        ->get();

        return view('management.adjustment', ['list' => $list, 'dept' => $dept]);
    }

    function show_management_attendance_adjustment_indiv($id){
        $curr = Auth::user();

        $emp = DB::table('Adjustment_Emp')
        ->select('filer.first_name AS filer_fname', 'filer.last_name AS filer_lname',
                'shifts.start_time', 'shifts.end_time', 
                'ap1.first_name AS ap1_fname', 'ap1.last_name AS ap1_lname',
                'ap2.first_name AS ap2_fname', 'ap2.last_name AS ap2_lname',
                'comments.comment1', 'comments.comment2',
                'departments.dept_name',
                'adjustment_emp.created_at AS file_date', 'adjustment_emp.reason', 'adjustment_emp.status1', 'adjustment_emp.status2', 'adjustment_emp.id',
                'attendance.created_at AS issue_date', 'attendance.id AS att_id',
                'old.time_in1 AS oti1', 'old.time_out1 AS oto1', 'old.time_in2 AS oti2', 'old.time_out2 AS oto2', 'old.time_in3 AS oti3', 'old.time_out3 AS oto3', 
                'new.time_in1 AS nti1', 'new.time_out1 AS nto1', 'new.time_in2 AS nti2', 'new.time_out2 AS nto2', 'new.time_in3 AS nti3', 'new.time_out3 AS nto3', 'new.id AS new_id',
                )
        ->join('users AS filer', 'filer.id', '=', 'adjustment_emp.emp_id')
        ->join('shift_emp', 'shift_emp.emp_id', '=', 'filer.id')
        ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_id')
        ->join('approvals', 'approvals.id', '=', 'filer.approval_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_id')
        ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_id')
        ->join('attendance', 'attendance.emp_id', '=', 'filer.id')
        ->join('time_adjustments AS old', 'old.id', '=', 'attendance.time_id')
        ->join('time_adjustments AS new', 'new.id', '=', 'adjustment_emp.time_id')
        ->join('departments', 'departments.id', 'filer.dept_id')
        ->join('comments', 'comments.id', '=', 'adjustment_emp.comment_id')
        ->where('Adjustment_Emp.id', '=', $id)
        ->get()->first();

        return view('management.adjustment-approvals-id', ['emp' => $emp]);
    }

    function show_management_shift_adjustment(){
        $curr = Auth::user();
        $dept = DB::table('users')->select('departments.dept_name')->join('departments', 'departments.id', '=', 'users.dept_id')->where('users.id', '=', $curr->id)->get()->first();

        $list = DB::table('Change_Shift_Emp')
        ->select(
            'Change_Shift_Emp.id',
            'filer.first_name', 'filer.last_name', 
            'departments.dept_name', 
            'shift_emp.start_date', 'shift_emp.end_date',
            'old.start_time', 'old.end_time', 'old.shift_name',
            'Change_Shift_Emp.created_at AS file_date', 'Change_Shift_Emp.status1', 'Change_Shift_Emp.status2',
        )
        ->join('users AS filer', 'filer.id', '=', 'Change_Shift_Emp.emp_id')
        ->join('approvals', 'approvals.id', '=', 'filer.approval_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_id')
        ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_id')
        ->join('shift_emp', 'shift_emp.id', '=', 'Change_Shift_Emp.shift_emp_id')
        ->join('shifts AS new', 'new.id', '=', 'Change_Shift_Emp.shift_id')
        ->join('shifts AS old', 'old.id', '=', 'shift_emp.shift_id')
        ->join('departments', 'departments.id', 'filer.dept_id')
        ->where('ap1.id', '=', $curr->id)
        ->orwhere('ap2.id', '=', $curr->id)
        ->get();

        return view('management.shift', ['list' => $list, 'dept' => $dept]);
    }

    function show_management_shift_adjustment_indiv($id){
        $curr = Auth::user();

        $emp = DB::table('Change_Shift_Emp')
        ->select(
            'Change_Shift_Emp.id',
            'filer.first_name', 'filer.last_name', 
            'ap1.first_name AS ap1_fname', 'ap1.last_name AS ap1_lname',
            'ap2.first_name AS ap2_fname', 'ap2.last_name AS ap2_lname',
            'departments.dept_name', 
            'comments.comment1', 'comments.comment2',
            'shift_emp.start_date', 'shift_emp.end_date', 'shift_emp.id AS shift_id', 
            'old.start_time AS old_start_time', 'old.end_time AS old_end_time', 'old.shift_name AS old_shift_name',
            'new.start_time AS new_start_time', 'new.end_time AS new_end_time', 'new.shift_name AS new_shift_name', 'new.id AS new_id',
            'Change_Shift_Emp.created_at AS file_date', 'Change_Shift_Emp.status1', 'Change_Shift_Emp.status2',
        )
        ->join('users AS filer', 'filer.id', '=', 'Change_Shift_Emp.emp_id')
        ->join('approvals', 'approvals.id', '=', 'filer.approval_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_id')
        ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_id')
        ->join('shift_emp', 'shift_emp.id', '=', 'Change_Shift_Emp.shift_emp_id')
        ->join('shifts AS new', 'new.id', '=', 'Change_Shift_Emp.shift_id')
        ->join('shifts AS old', 'old.id', '=', 'shift_emp.shift_id')
        ->join('departments', 'departments.id', 'filer.dept_id')
        ->join('comments', 'comments.id', '=', 'Change_Shift_Emp.comment_id')
        ->where('Change_Shift_Emp.id', '=', $id)
        ->get()->first();

        return view('management.shift-approval-id', ['emp' => $emp]);
    }

    function show_management_leaves(){
        $curr = Auth::user();
        $dept = DB::table('users')->select('departments.dept_name')->join('departments', 'departments.id', '=', 'users.dept_id')->where('users.id', '=', $curr->id)->get()->first();

        $list = DB::table('leave_emp')
        ->select(
            'leave_emp.id',
            'filer.first_name', 'filer.last_name', 
            'departments.dept_name', 
            'leave_emp.start_date', 'leave_emp.end_date',
            'main_leaves.main_leave_name',
            'leave_emp.created_at AS file_date', 'leave_emp.status1', 'leave_emp.status2',
        )
        ->join('users AS filer', 'filer.id', '=', 'leave_emp.emp_id')
        ->join('approvals', 'approvals.id', '=', 'filer.approval_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_id')
        ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_id')
        ->join('main_leaves', 'main_leaves.id', '=', 'leave_emp.main_leave_id')
        ->join('departments', 'departments.id', 'filer.dept_id')
        ->where('ap1.id', '=', $curr->id)
        ->orwhere('ap2.id', '=', $curr->id)
        ->get();

        return view('management.leave', ['list' => $list, 'dept' => $dept]);
    }

    function show_management_leaves_indiv($id){
        $curr = Auth::user();

        $emp = DB::table('leave_emp')
        ->select(
            'leave_emp.id',
            'filer.first_name', 'filer.last_name',
            'ap1.first_name AS ap1_fname', 'ap1.last_name AS ap1_lname',
            'ap2.first_name AS ap2_fname', 'ap2.last_name AS ap2_lname', 
            'departments.dept_name', 
            'comments.comment1', 'comments.comment2',
            'leave_emp.start_date', 'leave_emp.end_date', 'leave_emp.emp_ID', 'leave_emp.updated_at1', 'leave_emp.updated_at2',
            'main_leaves.main_leave_name',
            'leave_emp.created_at AS file_date', 'leave_emp.reason', 'leave_emp.document_file', 'leave_emp.status1', 'leave_emp.status2',
        )
        ->join('users AS filer', 'filer.id', '=', 'leave_emp.emp_id')
        ->join('approvals', 'approvals.id', '=', 'filer.approval_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_id')
        ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_id')
        ->join('main_leaves', 'main_leaves.id', '=', 'leave_emp.main_leave_id')
        ->join('departments', 'departments.id', 'filer.dept_id')
        ->join('comments', 'comments.id', '=', 'leave_emp.comment_id')
        ->where('leave_emp.id', '=', $id)
        ->get()->first();

        return view('management.leave-approval-id', ['emp' => $emp]);
    }

    function show_management_overtimes(){
        $curr = Auth::user();
        $dept = DB::table('users')->select('departments.dept_name')->join('departments', 'departments.id', '=', 'users.dept_id')->where('users.id', '=', $curr->id)->get()->first();


        $list = DB::table('Overtime_Emp')
        ->select(
            'Overtime_Emp.id',
            'filer.first_name', 'filer.last_name', 
            'departments.dept_name', 
            'Overtime_Emp.start_time', 'Overtime_Emp.end_time', 'Overtime_Emp.date', 'Overtime_Emp.reason',
            'Overtime_Emp.created_at AS file_date', 'Overtime_Emp.status1', 'Overtime_Emp.status2',
        )
        ->join('users AS filer', 'filer.id', '=', 'Overtime_Emp.emp_id')
        ->join('approvals', 'approvals.id', '=', 'filer.approval_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_id')
        ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_id')
        ->join('departments', 'departments.id', 'filer.dept_id')
        ->where('ap1.id', '=', $curr->id)
        ->orwhere('ap2.id', '=', $curr->id)
        ->get();

        return view('management.overtime', ['list' => $list, 'dept' => $dept]);
    }

    function show_management_overtimes_indiv($id){
        $curr = Auth::user();

        $emp = DB::table('Overtime_Emp')
        ->select(
            'Overtime_Emp.id',
            'filer.first_name', 'filer.last_name',
            'ap1.first_name AS ap1_fname', 'ap1.last_name AS ap1_lname',
            'ap2.first_name AS ap2_fname', 'ap2.last_name AS ap2_lname', 
            'departments.dept_name', 
            'comments.comment1', 'comments.comment2',
            'Overtime_Emp.start_time', 'Overtime_Emp.end_time', 'Overtime_Emp.date', 'Overtime_Emp.reason',
            'Overtime_Emp.created_at AS file_date', 'Overtime_Emp.status1', 'Overtime_Emp.status2',
        )
        ->join('users AS filer', 'filer.id', '=', 'Overtime_Emp.emp_id')
        ->join('approvals', 'approvals.id', '=', 'filer.approval_id')
        ->join('users AS ap1', 'ap1.id', '=', 'approvals.approval1_id')
        ->join('users AS ap2', 'ap2.id', '=', 'approvals.approval2_id')
        ->join('departments', 'departments.id', 'filer.dept_id')
        ->join('comments', 'comments.id', '=', 'Overtime_Emp.comment_id')
        ->where('Overtime_Emp.id', '=', $id)
        ->get()->first();

        return view('management.overtime-approval-id', ['emp' => $emp]);
    }

}
