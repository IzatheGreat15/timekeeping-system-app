<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_leave_ID',
        'sub_leave_name',
        'description',
    ];
}
