<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubLeaveController extends Controller
{
    /*
        Displays all sub leaves in database
    */
    public function show_sub_leave(){
        $leaves = DB::table('main_leaves')
                    ->select('*')
                    ->get();
        
        $subs = DB::table('sub_leaves')
                  ->select('sub_leaves.*', 'main_leaves.main_leave_name')
                  ->leftJoin('main_leaves', 'sub_leaves.main_leave_ID', '=', 'main_leaves.id')
                  ->get();

        return view('admin.leave-subcat', compact('leaves', 'subs'));
    }

    /*
        Displays the add new sub leave form
    */
    public function add_sub_leave(){
        $leaves = DB::table('main_leaves')
                    ->select('*')
                    ->get();

        return view('admin.leave-subcat-new', compact('leaves'));
    }

    /*
        Stores a new leave in database
    */
    public function store_sub_leave(Request $request){
        /* validate all fields */
        $request->validate([
            'sub_leave_name'    => 'required',
            'description'       => 'required',
            'main_leave_ID'     => 'required',
        ]);

        /* insert data */
        DB::table('sub_leaves')
            ->insert([
                'sub_leave_name'    => $request->sub_leave_name,   
                'description'       => $request->description,
                'main_leave_ID'     => $request->main_leave_ID,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

        return redirect('/leaves-subcategory')->with('success', 'Leave added successfully');
    }

    /*
        Shows the form for editting the leave in database
    */
    public function edit_sub_leave($id){
        $leave = DB::table('sub_leaves')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get()->first();

        $main = DB::table('main_leaves')
                        ->select('*')
                        ->get();


        return view('admin.leave-subcat-edit', compact('leave', 'main'));
    }

    /*
        Update a leave in database
    */
    public function update_sub_leave(Request $request){
        /* validate all fields */
        $request->validate([
            'sub_leave_name'    => 'required',
            'description'       => 'required',
            'main_leave_ID'     => 'required',
        ]);


        /* update data */
        DB::table('sub_leaves')->where('id', '=', $request->id)
            ->update([
                'sub_leave_name'    => $request->sub_leave_name,   
                'description'       => $request->description,
                'main_leave_ID'     => $request->main_leave_ID,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

        return redirect('/leaves-subcategory')->with('success', 'Leave edited successfully');
    }

    /*
        Delete a sub leave in database
    */
    public function delete_sub_leave(Request $request){
        /* delete data */
        DB::table('sub_leaves')->where('id', '=', $request->id)
                ->delete();

        return redirect('/leaves-subcategory')->with('success', 'Leave deleted successfully');
    }

    /*
        Search for leaves in database
    */
    public function search_sub_leave(Request $request){
        /* store search word to a variable */
        $info = $request->input('sub_leave_info');

        $leaves = DB::table('main_leaves')
                    ->select('*')
                    ->get();

        /* get search word from the database */
        /* make sure the search function is case insensitive; search in leave name, description, and balance */
        $subs = DB::table('sub_leaves')
                        ->select('sub_leaves.*', 'main_leaves.main_leave_name')
                        ->leftJoin('main_leaves', 'sub_leaves.main_leave_ID', '=', 'main_leaves.id')
                        ->where(DB::raw('lower(sub_leaves.sub_leave_name)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(sub_leaves.description)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(main_leaves.main_leave_name)'), 'like', '%' . strtolower($info) . '%')
                        ->get();

        if(isset($subs->first()->id))
            return view('admin.leave-subcat', compact('leaves', 'subs'));
        else
            return redirect('/leaves-subcategory')->with('error', 'No leave found. Try Again');
    }
}
