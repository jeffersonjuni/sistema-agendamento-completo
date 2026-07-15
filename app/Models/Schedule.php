<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'weekday',
        'is_open',
        'start_time',
        'end_time',
        'break_start',
        'break_end',
    ];


    protected $casts = [

        'is_open' => 'boolean',

        'start_time' => 'datetime:H:i',

        'end_time' => 'datetime:H:i',

        'break_start' => 'datetime:H:i',

        'break_end' => 'datetime:H:i',

    ];
}
