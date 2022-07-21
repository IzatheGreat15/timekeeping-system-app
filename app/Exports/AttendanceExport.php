<?php

namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $start_date, $end_date;

    function __construct($start_date, $end_date){
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $export = DB::table('attendance')
                ->select(
                    'users.id', 'users.first_name', 'users.last_name',
                    'attendance.created_at', 'shifts.start_time', 'shifts.end_time',
                    'time_adjustments.time_in1', 'time_adjustments.time_out1', 'time_adjustments.time_in2', 'time_adjustments.time_out2', 'time_adjustments.time_in3', 'time_adjustments.time_out3',
                )
                ->join('time_adjustments','time_adjustments.id','=','attendance.time_ID')
                ->join('shift_emp', 'shift_emp.emp_ID','=','attendance.emp_ID')
                ->join('shifts','shifts.id','=','shift_emp.shift_ID')
                ->join('users','users.id','=','attendance.emp_ID')
                ->join('approvals','approvals.id','=','users.approval_ID')
                ->where(function ($query) {
                        $query->whereBetween('attendance.created_at', [$this->start_date, $this->end_date])
                              ->orwhereDate('attendance.created_at', $this->start_date)
                              ->orwhereDate('attendance.created_at', $this->end_date);
                })
                ->where('users.dept_ID', '=', Auth::user()->dept_ID)
                ->get();

        return $export;
    }

    public function map($export): array
    {
        return [
            [
                $export->id,
                strtoupper($export->last_name.", ".$export->first_name),
                date('m/d/Y', strtotime($export->created_at)),
                date('h:i A', strtotime($export->start_time))." - ".date('h:i A', strtotime($export->end_time)),
                date('h:i A', strtotime($export->time_in1)),
                date('h:i A', strtotime($export->time_out1)),
                date('h:i A', strtotime($export->time_in2)),
                date('h:i A', strtotime($export->time_out2)),
                date('h:i A', strtotime($export->time_in3)),
                date('h:i A', strtotime($export->time_out3)),
            ],
        ];
    }

    public function headings(): array
    {
        return [
            "EID",
            "Employee Name",
            "Date",
            "Shift",
            "Time In 1",
            "Time Out 1",
            "Time In 2",
            "Time Out 2",
            "Time In 3",
            "Time Out 3",
        ];
    }
}
