<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ShiftController extends Controller
{
    /*
        Displays all shifts in database
    */
    public function show_shift(){
        $shifts = Shift::latest()->paginate(5);

        return view('admin.shift', compact('shifts'));
    }

    /*
        Stores a new shift in database
    */
    public function add_shift(Request $request){
        /* validate all fields */
        $request->validate([
            'shift_name'   => 'required',
            'start_time'   => 'required',
            'end_time'     => 'required',
            'break_start1' => 'required',
            'break_end1'   => 'required'
        ]);

        /* insert data */
        Shift::create($request->all());

        return redirect('/shifts')->with('success', 'Shift added successfully');
    }

    /*
        Shows the form for editting the shift in database
    */
    public function edit_shift($id){
        $shift = DB::table('shifts')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get()->first();

        return view('admin.shift-edit', compact('shift'));
    }

    /*
        Updates a shift in database
    */
    public function update_shift(Request $request){
        /* validate all fields */
        $request->validate([
            'shift_name'   => 'required',
            'start_time'   => 'required',
            'end_time'     => 'required',
            'break_start1' => 'required',
            'break_end1'   => 'required'
        ]);

        /* update data */
        DB::table('shifts')->where('id', '=', $request->id)
                ->update([
                    'shift_name'   => $request->shift_name,
                    'start_time'   => $request->start_time,
                    'end_time'     => $request->end_time,
                    'break_start1' => $request->break_start1,
                    'break_end1'   => $request->break_end1,
                    'break_start2' => $request->break_start2,
                    'break_end2'   => $request->break_end2,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

        return redirect('/shifts')->with('success', 'Shift updated successfully');
    }

    /*
        Delete a shift in database
    */
    public function delete_shift(Request $request){
        /* update data */
        DB::table('shifts')->where('id', '=', $request->id)
                ->delete();

        return redirect('/shifts')->with('success', 'Shift deleted successfully');
    }

    /*
        Search for shifts in database
    */
    public function search_shift(Request $request){
        /* store search word to a variable */
        $info = $request->input('shift_info');

        /* get search word from the database */
        /* make sure the search function is case insensitive; search in shift name, start time, and end time*/
        $shifts = DB::table('shifts')
                        ->select('*')
                        ->where(DB::raw('lower(shift_name)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(start_time)'), 'like', '%' . strtolower($info) . '%')
                        ->orWhere(DB::raw('lower(end_time)'), 'like', '%' . strtolower($info) . '%')
                        ->get();
        if(isset($shifts->first()->id))
            return view('admin.shift', compact('shifts'));
        else
            return redirect('/shifts')->with('error', 'No shift found. Try Again');
    }
}
