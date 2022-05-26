<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdjustmentEmp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdjustmentEmpController extends Controller
{
    /*
        Stores a new shift in database
    */
    public function add_adjustment(Request $request){
        /* validate all fields */
        $request->validate([
            'date'         => 'required',
            'reason'       => 'required',
            'time_in1'     => 'required',
            'time_out1'    => 'required'
        ]);

        $att_ID = DB::table('attendance')
                  ->select('*')
                  ->where('emp_ID', '=', Auth::user()->id)
                  ->whereDate('created_at', '=', $request->date)
                  ->get();
        
        /* If chosen date does not exist in the attendance record of the user */
        if($att_ID->count() == 0)
            return redirect('/adjustment-new')->with('error', 'Error! No attendance with the date selected exists.');

        //return redirect('/adjustment-new')->with('error', 'date selected exists.');
    }
}
