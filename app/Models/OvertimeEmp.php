<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeEmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_ID',
        'date',
        'start_time',
        'end_time',
        'reason',
        'comment_ID',
        'status1',
        'status2'
    ];
}
