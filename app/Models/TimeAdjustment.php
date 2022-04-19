<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_in1',
        'time_out1',
        'time_in2',
        'time_out2',
        'time_in3',
        'time_out3'
    ];
}
