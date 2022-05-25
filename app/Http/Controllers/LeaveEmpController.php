<?php

namespace App\Http\Controllers;

use App\Models\LeaveEmp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaveEmpController extends Controller
{
    /*
        Displays all leave requests of the user
    */
    public function show_leave_request(){

        $requests = DB::table('leave_emp')
                    ->select('leave_emp.*', 'users.first_name', 'users.last_name', 'main_leaves.main_leave_name')
                    ->join('main_leaves', 'main_leaves.id', '=', 'leave_emp.main_leave_ID')
                    ->join('users', 'users.id', '=', 'leave_emp.emp_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->where('leave_emp.emp_ID', '=', Auth::user()->id)
                    ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                    ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                    ->get();

        return view('employee.leave-request', compact('requests'));
    }

    /*
        Displays all CONFIRMED leave requests of the user
    */
    public function show_leave_record(){

        $requests = DB::table('leave_emp')
                    ->select('leave_emp.*', 'users.first_name', 'users.last_name', 'main_leaves.main_leave_name')
                    ->join('main_leaves', 'main_leaves.id', '=', 'leave_emp.main_leave_ID')
                    ->join('users', 'users.id', '=', 'leave_emp.emp_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->where('leave_emp.emp_ID', '=', Auth::user()->id)
                    ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                    ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                    ->where('leave_emp.status1', '=', 'APPROVED')
                    ->where('leave_emp.status2', '=', 'APPROVED')
                    ->get();

        return view('employee.leave-record', compact('requests'));
    }

    /*
        Displays a leave request/record of the user
    */
    public function view_leave_record($id){

        $req = DB::table('leave_emp')
                    ->select('leave_emp.*', 'users.first_name', 'users.last_name', 'main_leaves.main_leave_name', 'comments.*')
                    ->join('main_leaves', 'main_leaves.id', '=', 'leave_emp.main_leave_ID')
                    ->join('users', 'users.id', '=', 'leave_emp.emp_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->join('comments', 'comments.id', '=', 'leave_emp.comment_ID')
                    ->where('leave_emp.id', '=', $id)
                    ->get()->first();

        $approvals = DB::table('users')
                    ->select('users.*', 'approvals.*')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->where('users.id', '=', Auth::user()->id)
                    ->get()->first();

        return view('employee.leave-spec', compact('req', 'approvals'));
    }

    /*
        Show leave request form - add
    */
    public function new_leave_request(){
        $balance = DB::table('leave_bal_emp')
                   ->select('leave_bal_emp.*', 'main_leaves.*')
                   ->leftJoin('main_leaves', 'main_leaves.id', '=', 'leave_bal_emp.main_leave_ID')
                   ->where('leave_bal_emp.emp_ID', '=', Auth::user()->id)
                   ->get();

        $main = DB::table('leave_bal_emp')
                   ->select('main_leaves.*')
                   ->join('main_leaves', 'main_leaves.id', '=', 'leave_bal_emp.main_leave_ID')
                   ->where('leave_bal_emp.emp_ID', '=', Auth::user()->id)
                   ->where('leave_bal_emp.balance', '>', 0)
                   ->get();

        return view('employee.leave-request-new', compact('balance', 'main'));
    }

    /*
        Show leave request form - edit
    */
    public function edit_leave_request($id){
        $balance = DB::table('leave_bal_emp')
                   ->select('leave_bal_emp.*', 'main_leaves.*')
                   ->leftJoin('main_leaves', 'main_leaves.id', '=', 'leave_bal_emp.main_leave_ID')
                   ->where('leave_bal_emp.emp_ID', '=', Auth::user()->id)
                   ->get();

        $main = DB::table('leave_bal_emp')
                   ->select('main_leaves.*')
                   ->join('main_leaves', 'main_leaves.id', '=', 'leave_bal_emp.main_leave_ID')
                   ->where('leave_bal_emp.emp_ID', '=', Auth::user()->id)
                   ->where('leave_bal_emp.balance', '>', 0)
                   ->get();

        $leave = DB::table('leave_emp')
                   ->select('*')
                   ->where('id', '=', $id)
                   ->get()->first();

        return view('employee.leave-request-edit', compact('balance', 'main', 'leave'));
    }

    /*
        Store a new leave request in the database
     */
    public function add_leave_request(Request $request){
        /* validate all fields */
        $request->validate([
            'start_date'       => 'required',
            'end_date'         => 'required',
            'leave_ID'         => 'required',
            'reason'           => 'required|max:255',
            'document_file'    => 'mimes:jped,png,jpg,svg,doc,docx,pdf|max:2048'
        ]);

        $main_leave_ID = $sub_leave_ID = NULL;

        /* determine whether the selected leave is a main leave or sub leave */

        /* if it is sub leave, get the main leave id */
        if($request->leave_ID[strlen($request->leave_ID) - 1] == "S"){
            $sub_leave_ID = rtrim($request->leave_ID, $request->leave_ID[strlen($request->leave_ID) - 1]." ");

            $main = DB::table('sub_leaves')
                      ->select('main_leave_ID')
                      ->where('id', '=', $sub_leave_ID)
                      ->get()->first();
            
            $main_leave_ID = $main->main_leave_ID;
        } else {
            $main_leave_ID = $request->leave_ID;
        }

        /* save file in the folder of the user */
        if($file = $request->file('document_file')){
            $path = 'supporting_docs/'. Auth::user()->id . '/';
            $fileName = date('YmdHis'). "." . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $request->document_file = $fileName;
        }

        /* create an entry in the comments table and get id */
        $comment_ID = DB::table('comments')
                      ->insertGetId([
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                      ]);
        
        /* insert data to database */ 
        DB::table('leave_emp')
        ->insert([
            'emp_ID'            => Auth::user()->id,
            'main_leave_ID'     => $main_leave_ID,
            'sub_leave_ID'      => $sub_leave_ID,
            'start_date'        => $request->start_date,
            'end_date'          => $request->end_date,
            'reason'            => $request->reason,
            'comment_ID'        => $comment_ID,
            'status1'           => 'PENDING',
            'status2'           => 'PENDING',
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'document_file'     => $request->document_file
        ]);

        /* send notification via email and notification to immediate superior */

        return redirect('/leave-request')->with('success', 'Leave request filed successfully');
    }

    /*
        update a leave request in the database
     */
    public function update_leave_request(Request $request){

        /* validate all fields */
        $request->validate([
            'start_date'       => 'required',
            'end_date'         => 'required',
            'leave_ID'         => 'required',
            'reason'           => 'required|max:255',
        ]);

        $main_leave_ID = $sub_leave_ID = NULL;
        echo $request->document_file." ";
        /* determine whether the selected leave is a main leave or sub leave */

        /* if it is sub leave, get the main leave id */
        if($request->leave_ID[strlen($request->leave_ID) - 1] == "S"){
            $sub_leave_ID = rtrim($request->leave_ID, $request->leave_ID[strlen($request->leave_ID) - 1]." ");

            $main = DB::table('sub_leaves')
                      ->select('main_leave_ID')
                      ->where('id', '=', $sub_leave_ID)
                      ->get()->first();
            
            $main_leave_ID = $main->main_leave_ID;
        } else {
            $main_leave_ID = $request->leave_ID;
        }

        if($file = $request->file('document_file')){
            $path = 'supporting_docs/'. Auth::user()->id . '/';
            $fileName = date('YmdHis'). "." . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            DB::table('leave_emp')->where('id', '=', $request->id)
            ->update([
                'document_file'         => $fileName
            ]);
        }

        DB::table('leave_emp')->where('id', '=', $request->id)
            ->update([
                'main_leave_ID'     => $main_leave_ID,
                'sub_leave_ID'      => $sub_leave_ID,
                'start_date'        => $request->start_date,
                'end_date'          => $request->end_date,
                'reason'            => $request->reason,
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
        
            return redirect('/leave-request')->with('success', 'Leave request updated successfully');
    }

    /**
     * Soft delete a leave request (change statuses to cancelled)
     */
    public function delete_leave_request(Request $request){
        DB::table('leave_emp')->where('id', '=', $request->id)
            ->update([
                'status1'   => "CANCELLED",
                'status2'   => "CANCELLED"
            ]);

        return redirect('/leave-request')->with('success', 'Leave request cancelled successfully');
    }

    /*
        Search for a leave request
     */
    public function search_leave_request(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $name = $request->name;
        $status = $request->status;

        /* search for entries in database that matches with inputs from the form */
        $requests = DB::table('leave_emp')
                    ->select('leave_emp.*', 'users.first_name', 'users.last_name', 'main_leaves.main_leave_name')
                    ->join('main_leaves', 'main_leaves.id', '=', 'leave_emp.main_leave_ID')
                    ->join('users', 'users.id', '=', 'leave_emp.emp_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->where('leave_emp.emp_ID', '=', Auth::user()->id)
                    ->orWhere('approvals.approval1_ID', '=', Auth::user()->id)
                    ->orWhere('approvals.approval2_ID', '=', Auth::user()->id)
                    ->whereBetween('leave_emp.start_date', [$start_date, $end_date])
                    ->orWhereBetween('leave_emp.end_date', [$start_date, $end_date])
                    ->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($name) . '%')
                    ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($name) . '%')
                    ->where('leave_emp.status1', '=', $status)
                    ->orWhere('leave_emp.status2', '=', $status)
                    ->get();
        if($requests->count() > 0)
            return view('employee.leave-request', compact('requests'));
        else
        echo "no found";
           // return redirect('/leave-request')->with('error', 'No leave request found. Try Again');
    }
}
