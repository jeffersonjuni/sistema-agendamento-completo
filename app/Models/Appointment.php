<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'duration',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'status' => AppointmentStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function service()
    {
        return $this->belongsTo(
            Service::class
        )->withTrashed();
    }
}
