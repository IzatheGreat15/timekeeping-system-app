<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeShiftEmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_ID',
        'shift_emp_ID',
        'shift_ID',
        'comment_ID',
        'status1',
        'status2'
    ];
}
