<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_leave_name',
        'description',
        'total_balance'
    ];
}
