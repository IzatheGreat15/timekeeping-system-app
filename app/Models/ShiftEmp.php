<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftEmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_ID',
        'shift_ID',
        'start_date',
        'end_date',
    ];
}
