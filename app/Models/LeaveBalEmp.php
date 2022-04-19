<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalEmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_ID',
        'main_leave_ID',
        'balance'
    ];
}
