<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChangeShiftEmpController extends Controller
{
    /*
        Show add form
     */
    public function new_change_shift(){
        $assigned = DB::table('shift_emp')
                    ->select('shift_emp.*', 'shifts.*')
                    ->join('shifts', 'shifts.id', '=', 'shift_emp.shift_ID')
                    ->where('shift_emp.emp_ID', '=', Auth::user()->id)
                    ->get();

        return view('employee.shift-change-new', compact('assigned'));
    }
}
