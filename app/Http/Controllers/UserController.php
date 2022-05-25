<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /*
        Displays all accounts in database
    */
    public function show_account(){
        $accs = DB::table('users')
                    ->select('users.*', 'departments.dept_name', 'approvals.approval1_ID')
                    ->join('departments', 'departments.id', '=', 'users.dept_ID')
                    ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                    ->where('users.status', '=', 'ACTIVE')
                    ->get();
        $test = DB::table('users')->select('first_name')->where('id', '=', 1)->get()->first();

        return view('admin.account', compact('accs', 'test'));
    }

    /*
        Displays add form in database
    */
    public function new_account(){
        $depts = DB::table('departments')
                    ->select('*')
                    ->get();

        return view('admin.account-new', compact('depts'));
    }

    /*
        Displays form with dynamic dropdown in database
    */
    public function account_dropdown(Request $request){
        $subs = DB::table('users')
                    ->select('*')
                    ->where('dept_ID', '=', $request->id)
                    ->where('role', '=', 'Management')
                    ->get();

        return response()->json($subs);

    }

    /*
        Stores a new account in database
    */
    public function store_account(Request $request){
        /* validate all fields */
        $request->validate([
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|unique:users,email',
            'password'         => 'required',
            'position'         => 'required',
            'dept_ID'          => 'required',
            'role'             => 'required',
            ''
        ]);

        /* insert data and get the id of the newly inserted data */
        $id = DB::table('users')
            ->insertGetId([
                'first_name'         => $request->first_name,   
                'last_name'          => $request->last_name,
                'email'              => $request->email,
                'password'           => Hash::make($request->password),
                'position'           => $request->position,
                'status'             => "ACTIVE",
                'dept_ID'            => $request->dept_ID,
                'role'               => $request->role          
            ]);

        /*if the user has no sub_ID or approval_ID, store their own id */
        $subID = ($request->sub_ID == "NULL")? $id : $request->sub_ID;
        $approval1ID = ($request->approval_ID == "NULL")? $id : $request->approval_ID;
         
        /* create an entry in approvals table for the user and get id of newly created entry */
        $approvals = DB::table('approvals')
                        ->insertGetId([
                            'approval1_ID'      => $approval1ID,
                            'approval2_ID'      => NULL,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        ]);

        /* insert subID and approvalID to user table for the user */
        DB::table('users')->where('id', '=', $id)
            ->update([
                'sub_ID'             => $subID,
                'approval_ID'        => $approvals, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s')    
            ]);

        /* set the second approver as the immediate superior of the first approver */
        $approval2 = DB::table('users')
                        ->select('approvals.approval1_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where('users.id', '=', $approval1ID)
                        ->get()->first();

        $approval2ID = ($approval2->approval1_ID == "NULL")? $id : $approval2->approval1_ID; 
        
        /* insert subID and approvalID to user table for the user */
        DB::table('approvals')->where('id', '=', $approvals)
            ->update([
                'approval2_ID'       => $approval2ID, 
                'updated_at'         => date('Y-m-d H:i:s')    
            ]);

        /* create entries for the user in the leave_bal_emp table to store their balance of their leaves */

        /* get all the main leaves */
        $leaves = DB::table('main_leaves')
                    ->select('*')
                    ->get();
        
        /* loop through leaves table and create leave_bal_emp with the newly created user for each main leaves */
        foreach($leaves as $leave){
            DB::table('leave_bal_emp')
                ->insert([
                    'emp_ID'            => $id,
                    'main_leave_ID'     => $leave->id,
                    'balance'           => $leave->total_balance,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);
        }

        return redirect('/accounts')->with('success', 'Account added successfully');
    }

    /*
        Show the edit form of the accounts
    */
    public function edit_account($id){
        $acc = DB::table('users')
                ->select('users.*', 'approvals.approval1_ID')
                ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                ->where('users.id', '=', $id)
                ->get()->first();

        $depts = DB::table('departments')
                ->select('*')
                ->get();
        return view('admin.account-edit', compact('depts', 'acc'));
    }

    /*
        Update an account in database
    */
    public function update_account(Request $request){
        DB::table('users')->where('id', '=', $request->id)
            ->update([
                'email'              => " "
            ]);

        /* validate all fields */
        $request->validate([
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|unique:users,email',
            'position'         => 'required',
            'status'           => 'required',
            'dept_ID'          => 'required',
            'sub_ID'           => 'required',
            'approval_ID'      => 'required',
            'role'             => 'required',
        ]);

        /* update user in database */
        DB::table('users')->where('id', '=', $request->id)
            ->update([
                'first_name'         => $request->first_name,   
                'last_name'          => $request->last_name,
                'email'              => $request->email,
                'position'           => $request->position,
                'status'             => $request->status,
                'dept_ID'            => $request->dept_ID,
                'sub_ID'             => $request->sub_ID,
                'role'               => $request->role,
                'updated_at'         => date('Y-m-d H:i:s')
            ]);

        /* get the immediate superior of the first approver of the user */
        $second_approval = DB::table('users')
                        ->select('approvals.approval1_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where('users.id', '=', $request->approval_ID)
                        ->get()->first();
        
        /* get the approval id of the user */
        $approvalID = DB::table('users')
                        ->select('*')
                        ->where('id', '=', $request->id)
                        ->get()->first();

        /* update the user's approvals */
        DB::table('approvals')->where('id', '=', $approvalID->approval_ID)
            ->update([
                'approval1_ID'      => $request->approval_ID,
                'approval2_ID'      => $second_approval->approval1_ID,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

        return redirect('/accounts')->with('success', 'Account edited successfully');
    }

    /**
     * Soft delete an account (change status to inactive)
     */
    public function delete_account(Request $request){
        DB::table('users')->where('id', '=', $request->id)
            ->update([
                'status'   => "INACTIVE"
            ]);

        return redirect('/accounts')->with('success', 'Account deleted successfully');
    }

    /*
        Search for accounts in database
    */
    public function search_account(Request $request){
        /* store search word to a variable */
        $info = $request->input('account_info');
        $name = strtok($info, " ");

        /* get search word from the database */
        /* make sure the search function is case insensitive; search in leave name, description, and balance */
        $accs = DB::table('users')
                        ->select('users.*', 'departments.dept_name', 'approvals.approval1_ID')
                        ->join('departments', 'departments.id', '=', 'users.dept_ID')
                        ->join('approvals', 'approvals.id', '=', 'users.approval_ID')
                        ->where('users.status', '=', 'ACTIVE')
                        ->where(DB::raw('lower(users.first_name)'), 'like', '%' . strtolower($name) . '%')
                        ->orWhere(DB::raw('lower(users.last_name)'), 'like', '%' . strtolower($name) . '%')
                        ->orWhere(DB::raw('lower(users.email)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(users.position)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(departments.dept_name)'), 'like', '%' . strtolower($info) . '%')
                        ->get();

        if(isset($accs->first()->id))
            return view('admin.account', compact('accs'));
        else
            return redirect('/accounts')->with('error', 'No account found. Try Again');
    }

    /*
        Logout user
    */
    public function logout_user(){
        
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
