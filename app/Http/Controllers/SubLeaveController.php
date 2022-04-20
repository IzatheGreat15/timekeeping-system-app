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
                    ->count();
        
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
}
