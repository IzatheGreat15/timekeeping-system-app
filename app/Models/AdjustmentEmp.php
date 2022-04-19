<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentEmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_ID',
        'time_ID',
        'att_ID',
        'reason',
        'comment_ID',
        'status1',
        'status2'
    ];
}
