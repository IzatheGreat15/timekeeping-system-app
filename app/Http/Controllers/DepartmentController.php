<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    /*
        Displays all departments in database
    */
    public function show_department(){
        $departments = Department::latest()->paginate(5);

        return view('admin.department', compact('departments'));
    }

    /*
        Stores a new department in database
    */
    public function add_department(Request $request){
        /* validate all fields */
        $request->validate([
            'dept_name' => 'required',
            'description' => 'required',
        ]);

        /* insert data */
        Department::create($request->all());

        return redirect('/departments')->with('success', 'Department added successfully');
    }

    /*
        Shows the form for editting the department in database
    */
    public function edit_department($id){
        $departments = DB::table('departments')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get()->first();

        return view('admin.department-edit', compact('departments'));
    }

    /*
        Updates a department in database
    */
    public function update_department(Request $request){
        /* validate all fields */
        $request->validate([
            'dept_name' => 'required',
            'description' => 'required',
        ]);

        /* update data */
        DB::table('departments')->where('id', '=', $request->id)
                ->update([
                    'dept_name'   => $request->dept_name,
                    'description' => $request->description,
                    'updated_at'  => date('Y-m-d H:i:s')
                ]);

        return redirect('/departments')->with('success', 'Department updated successfully');
    }

    /*
        Delete a department in database
    */
    public function delete_department(Request $request){
        /* delete data */
        DB::table('departments')->where('id', '=', $request->id)
                ->delete();

        return redirect('/departments')->with('success', 'Department deleted successfully');
    }

    /*
        Search for departments in database
    */
    public function search_department(Request $request){
        /* store search word to a variable */
        $info = $request->input('dept_info');

        /* get search word from the database */
        /* make sure the search function is case insensitive; search in department name and description */
        $departments = DB::table('departments')
                        ->select('*')
                        ->where(DB::raw('lower(dept_name)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(description)'), 'like', '%' . strtolower($info) . '%')
                        ->get();
        if(isset($departments->first()->id))
            return view('admin.department', compact('departments'));
        else
            return redirect('/departments')->with('error', 'No department found. Try Again');
    }

}
