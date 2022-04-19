<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveEmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_ID',
        'main_leave_ID',
        'sub_leave_ID',
        'start_date',
        'end_date',
        'comment_ID',
        'status1',
        'status2'
    ];
}
