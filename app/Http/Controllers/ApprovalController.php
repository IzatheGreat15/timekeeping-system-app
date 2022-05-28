<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Notifications\NotifRequest;

use App\Models\User;

class ApprovalController extends Controller
{
    
    function approve_attendance(Request $request){


        $curr = Auth::user();
        $var = DB::table('Adjustment_Emp')->where('id', '=', $request->id)->get()->first();
        $notificand = User::find($var->emp_ID);
        $url = url('/adjustment-records/'.$request->id);

        switch($request->submit){
            case '-1': 
                if($var->status1 == "PENDING"){
                    $message = "Your Attendance Request has been REJECTED.";
                    $ender = "Try Again Later.";

                    DB::table('Adjustment_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "REJECTED",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('Adjustment_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "REJECTED",
                        'updated_at2' => now(),
                    ]);
                }
                break;
            case '0':
                $message = "Your Attendance Request has been SENT BACK.";
                $ender = "Please revise your request.";

                if($var->status1 == "PENDING"){
                    DB::table('Adjustment_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "SENT BACK",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('Adjustment_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "SENT BACK",
                        'updated_at2' => now(),
                    ]);
                }
                break;
            case '1':
                $message = "Your Attendance Request has been PARTIALLY APPROVED.";
                $ender = " Congratulations.";

                if($var->status1 == "PENDING"){
                    DB::table('Adjustment_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "APPROVED",
                        'updated_at1' => now(),
                    ]);
                    if($var->status2 == "APPROVED"){
                        $message = "Your Attendance Request has been FULLY APPROVED.";
                        DB::table('attendance')->where('id', '=', $request->att_id)
                        ->update([
                            'time_id' => $request->new_id,
                        ]);
                    }
                }elseif($var->status2 == "PENDING"){
                    $message = "Your Attendance Request has been FULLY APPROVED.";
                    DB::table('Adjustment_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "APPROVED",
                        'updated_at2' => now(),
                    ]);
                    if($var->status1 == "APPROVED"){
                        $message = "Your Attendance Request has been FULLY APPROVED.";
                        DB::table('attendance')->where('id', '=', $request->att_id)
                        ->update([
                            'time_id' => $request->new_id,
                        ]);
                    }
                }
                break;
        }
        if($var->status1 == "PENDING"){
            DB::table('Adjustment_Emp')
            ->join('comments', 'comments.id', '=', 'adjustment_emp.comment_id')
            ->where('adjustment_emp.id', '=', $request->id)
            ->update([
                'comments.comment1' => $request->managementComment,
            ]);
        }elseif($var->status2 == "PENDING"){
            DB::table('Adjustment_Emp')
            ->join('comments', 'comments.id', '=', 'adjustment_emp.comment_id')
            ->where('adjustment_emp.id', '=', $request->id)
            ->update([
                'comments.comment2' => $request->managementComment,
            ]);
        }
        $notificand->notify(new NotifRequest($notif_info = [
            'message' => $message,
            'url' => $url,
            'ender' => $ender,
        ]));
        DB::table('notifications')->insert([
            'message' => $message,
            'emp_id' => $var->emp_ID,
            'url' => $url,
            'ref_tab' => 'ATT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect('/approve-adjustments');
    }
    function approve_shift(Request $request){
        $curr = Auth::user();
        $var = DB::table('Change_Shift_Emp')->where('id', '=', $request->id)->get()->first();
        $notificand = User::find($var->emp_ID);
        $url = url('/shift-change/'.$request->id);

        switch($request->submit){
            case '-1': 
                $message = "Your Shift Change Request has been REJECTED.";
                $ender = "Try Again Later.";
                if($var->status1 == "PENDING"){
                    DB::table('Change_Shift_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "REJECTED",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('Change_Shift_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "REJECTED",
                        'updated_at2' => now(),
                    ]);
                }
                break;
            case '0':
                $message = "Your Shift Change Request has been SENT BACK.";
                $ender = "Please revise your request.";
                if($var->status1 == "PENDING"){
                    DB::table('Change_Shift_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "SENT BACK",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('Change_Shift_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "SENT BACK",
                        'updated_at2' => now(),
                    ]);
                }
                break;
            case '1':
                $message = "Your Shift Change Request has been PARTIALLY APPROVED.";
                $ender = "Congratulations.";
                if($var->status1 == "PENDING"){
                    DB::table('Change_Shift_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "APPROVED",
                        'updated_at1' => now(),
                    ]);
                    if($var->status2 == "APPROVED"){
                        $message = "Your Shift Change Request has been FULLY APPROVED.";
                        $ender = "Congratulations.";
                        DB::table('shift_emp')->where('id', '=', $request->shift_id)
                        ->update([
                            'shift_id' => $request->new_id,
                        ]);
                    }
                }elseif($var->status2 == "PENDING"){
                    DB::table('Change_Shift_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "APPROVED",
                        'updated_at2' => now(),
                    ]);
                    if($var->status1 == "APPROVED"){
                        $message = "Your Shift Change Request has been FULLY APPROVED.";
                        $ender = "Congratulations.";
                        DB::table('shift_emp')->where('id', '=', $request->shift_id)
                        ->update([
                            'shift_id' => $request->new_id,
                        ]);
                    }
                }
                break;
        }
        if($var->status1 == "PENDING"){
            DB::table('Change_Shift_Emp')
            ->join('comments', 'comments.id', '=', 'Change_Shift_Emp.comment_id')
            ->where('Change_Shift_Emp.id', '=', $request->id)
            ->update([
                'comments.comment1' => $request->managementComment,
            ]);
        }elseif($var->status2 == "PENDING"){
            DB::table('Change_Shift_Emp')
            ->join('comments', 'comments.id', '=', 'Change_Shift_Emp.comment_id')
            ->where('Change_Shift_Emp.id', '=', $request->id)
            ->update([
                'comments.comment2' => $request->managementComment,
            ]);
        }
        $notificand->notify(new NotifRequest($notif_info = [
            'message' => $message,
            'url' => $url,
            'ender' => $ender,
        ]));
        DB::table('notifications')->insert([
            'message' => $message,
            'emp_id' => $var->emp_ID,
            'url' => $url,
            'ref_tab' => 'SFT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect('/approve-shift-change');
    }
    function approve_leave(Request $request){
        $curr = Auth::user();
        $var = DB::table('leave_emp')->where('id', '=', $request->id)->get()->first();
        $notificand = User::find($var->emp_ID);
        $url = url('/leave-records/'.$request->id);

        switch($request->submit){
            case '-1': 
                $message = "Your Leave Request has been REJECTED.";
                $ender = "Try Again Later.";
                if($var->status1 == "PENDING"){
                    DB::table('leave_emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "REJECTED",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('leave_emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "REJECTED",
                        'updated_at2' => now(),
                    ]);
                }
                break;
            case '0':
                $message = "Your Leave Request has been SENT BACK.";
                $ender = "Please revise your request.";
                if($var->status1 == "PENDING"){
                    DB::table('leave_emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "SENT BACK",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('leave_emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "SENT BACK",
                        'updated_at2' => now(),
                    ]);
                }
                break;
            case '1':
                $message = "Your Leave Request has been PARTIALLY APPROVED.";
                $ender = "Congratulations.";
                if($var->status1 == "PENDING"){
                    DB::table('leave_emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "APPROVED",
                        'updated_at1' => now(),
                    ]);
                    if($var->status2 == "APPROVED"){
                        $message = "Your Leave Request has been FULLY APPROVED.";
                        $ender = "Congratulations.";
                        DB::table('leave_bal_emp')->where('emp_id', '=', $var->emp_ID)->where('main_leave_id', '=', $var->main_leave_ID)
                        ->update([
                            'balance' => DB::table('leave_bal_emp')->select('balance')->where('emp_id', '=', $var->emp_ID)->where('main_leave_id', '=', $var->main_leave_ID)->get()->first()->balance - 1,
                        ]);
                    }
                }elseif($var->status2 == "PENDING"){
                    DB::table('leave_emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "APPROVED",
                        'updated_at2' => now(),
                    ]);
                    if($var->status1 == "APPROVED"){
                        $message = "Your Leave Request has been FULLY APPROVED.";
                        $ender = "Congratulations.";
                        DB::table('leave_bal_emp')->where('emp_id', '=', $var->emp_ID)->where('main_leave_id', '=', $var->main_leave_ID)
                        ->update([
                            'balance' => DB::table('leave_bal_emp')->select('balance')->where('emp_id', '=', $var->emp_ID)->where('main_leave_id', '=', $var->main_leave_ID)->get()->first()->balance - 1,
                        ]);
                    }
                }
                break;
        }
        if($var->status1 == "PENDING"){
            DB::table('leave_emp')
            ->join('comments', 'comments.id', '=', 'leave_emp.comment_id')
            ->where('leave_emp.id', '=', $request->id)
            ->update([
                'comments.comment1' => $request->managementComment,
            ]);
        }elseif($var->status2 == "PENDING"){
            DB::table('leave_emp')
            ->join('comments', 'comments.id', '=', 'leave_emp.comment_id')
            ->where('leave_emp.id', '=', $request->id)
            ->update([
                'comments.comment2' => $request->managementComment,
            ]);
        }
        $notificand->notify(new NotifRequest($notif_info = [
            'message' => $message,
            'url' => $url,
            'ender' => $ender,
        ]));
        DB::table('notifications')->insert([
            'message' => $message,
            'emp_id' => $var->emp_ID,
            'url' => $url,
            'ref_tab' => 'LVE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect('/approve-leaves');
    }
    function approve_overtime(Request $request){
        $curr = Auth::user();
        $var = DB::table('Overtime_Emp')->where('id', '=', $request->id)->get()->first();
        $notificand = User::find($var->emp_ID);
        $url = url('/overtime-request/'.$request->id);

        switch($request->submit){
            case '-1': 
                $message = "Your Overtime Request has been REJECTED.";
                $ender = "Try Again Later.";
                if($var->status1 == "PENDING"){
                    DB::table('Overtime_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "REJECTED",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('Overtime_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "REJECTED",
                        'updated_at2' => now(),
                    ]);
                }
                break;
            case '0':
                $message = "Your Overtime Request has been SENT BACK.";
                $ender = "Please revise your request.";
                if($var->status1 == "PENDING"){
                    DB::table('Overtime_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "SENT BACK",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('Overtime_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "SENT BACK",
                        'updated_at2' => now(),
                    ]);
                }
                break;
            case '1':
                $message = "Your Overtime Request has been PARTIALLY APPROVED.";
                $ender = "Congratulations.";
                if($var->status1 == "PENDING"){
                    DB::table('Overtime_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status1' => "APPROVED",
                        'updated_at1' => now(),
                    ]);
                }elseif($var->status2 == "PENDING"){
                    DB::table('Overtime_Emp')->where('id', '=', $request->id)
                    ->update([
                        'status2' => "APPROVED",
                        'updated_at2' => now(),
                    ]);
                }
                break;
        }
        $var = DB::table('Overtime_Emp')->where('id', '=', $request->id)->get()->first();
        if($var->status1 == "APPROVED" && $var->status2 == "APPROVED"){
            $message = "Your Overtime Request has been FULLY APPROVED.";
            $ender = "Congratulations.";
        }
        if($var->status1 == "PENDING"){
            DB::table('Overtime_Emp')
            ->join('comments', 'comments.id', '=', 'Overtime_Emp.comment_id')
            ->where('Overtime_Emp.id', '=', $request->id)
            ->update([
                'comments.comment1' => $request->managementComment,
            ]);
        }elseif($var->status2 == "PENDING"){
            DB::table('Overtime_Emp')
            ->join('comments', 'comments.id', '=', 'Overtime_Emp.comment_id')
            ->where('Overtime_Emp.id', '=', $request->id)
            ->update([
                'comments.comment2' => $request->managementComment,
            ]);
        }
        $notificand->notify(new NotifRequest($notif_info = [
            'message' => $message,
            'url' => $url,
            'ender' => $ender,
        ]));
        DB::table('notifications')->insert([
            'message' => $message,
            'emp_id' => $var->emp_ID,
            'url' => $url,
            'ref_tab' => 'OVT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect('/approve-overtimes');
    }

    function show_notifs(){
        $listATT = DB::table('notifications')
            ->where('emp_id', '=', Auth::user()->id)
            ->where('ref_tab', '=', 'ATT')
            ->get();
        $listSFT = DB::table('notifications')
            ->where('emp_id', '=', Auth::user()->id)
            ->where('ref_tab', '=', 'SFT')
            ->get();
        $listLVE = DB::table('notifications')
            ->where('emp_id', '=', Auth::user()->id)
            ->where('ref_tab', '=', 'LVE')
            ->get();
        $listOVT = DB::table('notifications')
            ->where('emp_id', '=', Auth::user()->id)
            ->where('ref_tab', '=', 'OVT')
            ->get();

        return View('general.notifications', [
            'ATT' => $listATT, 
            'SFT' => $listSFT,
            'LVE' => $listLVE, 
            'OVT' => $listOVT,
        ]);
    }
}
