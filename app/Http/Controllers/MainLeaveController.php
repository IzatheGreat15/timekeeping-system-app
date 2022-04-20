<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main_Leave;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class MainLeaveController extends Controller
{
    /*
        Displays all main leaves in database
    */
    public function show_main_leave(){
        $leaves = DB::table('main_leaves')
                    ->select('*')
                    ->get();

        return view('admin.leave-cat', compact('leaves'));
    }

    /*
        Displays a specific main leaves in database
    */
    public function display_main_leave($id){
        $leave = DB::table('main_leaves')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get()->first();

        $sub_leaves = DB::table('sub_leaves')
                        ->select('*')
                        ->where('main_leave_ID', '=', $id)
                        ->get();                        

        return view('admin.leave-cat-spec', compact('leave', 'sub_leaves'));
    }

    /*
        Stores a new leave in database
    */
    public function add_main_leave(Request $request){
        /* validate all fields */
        $request->validate([
            'main_leave_name'    => 'required',
            'description'        => 'required',
            'total_balance'      => 'required',
            'req_doc'            => 'required'
        ]);

        /* insert data */
        DB::table('main_leaves')
            ->insert([
                'main_leave_name'    => $request->main_leave_name,   
                'description'        => $request->description,
                'total_balance'      => $request->total_balance,
                'req_doc'            => $request->req_doc,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s')
            ]);

        return redirect('/leaves-category')->with('success', 'Leave added successfully');
    }

    /*
        Shows the form for editting the leave in database
    */
    public function edit_main_leave($id){
        $leave = DB::table('main_leaves')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get()->first();

        return view('admin.leave-cat-edit', compact('leave'));
    }

    /*
        Update a leave in database
    */
    public function update_main_leave(Request $request){
        /* validate all fields */
        $request->validate([
            'main_leave_name'    => 'required',
            'description'        => 'required',
            'total_balance'      => 'required',
            'req_doc'            => 'required'
        ]);


        /* update data */
        DB::table('main_leaves')->where('id', '=', $request->id)
            ->update([
                'main_leave_name'    => $request->main_leave_name,   
                'description'        => $request->description,
                'total_balance'      => $request->total_balance,
                'req_doc'            => $request->req_doc,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s')
            ]);

        return redirect('/leaves-category')->with('success', 'Leave edited successfully');
    }

    /*
        Delete a main leave in database
    */
    public function delete_main_leave(Request $request){
        /* delete data */
        DB::table('main_leaves')->where('id', '=', $request->id)
                ->delete();

        return redirect('/leaves-category')->with('success', 'Leave deleted successfully');
    }

    /*
        Search for leaves in database
    */
    public function search_main_leave(Request $request){
        /* store search word to a variable */
        $info = $request->input('main_leave_info');

        /* get search word from the database */
        /* make sure the search function is case insensitive; search in leave name, description, and balance */
        $leaves = DB::table('main_leaves')
                        ->select('*')
                        ->where(DB::raw('lower(main_leave_name)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(description)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(total_balance)'), 'like', '%' . strtolower($info) . '%')
                        ->get();
        if(isset($leaves->first()->id))
            return view('admin.leave-cat', compact('leaves'));
        else
            return redirect('/leaves-category')->with('error', 'No leave found. Try Again');
    }
}
