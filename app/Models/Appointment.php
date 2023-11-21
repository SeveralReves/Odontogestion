<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'date', 'hour', 'status_id', 'appointments_type_id', 'notes'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(AppointmentStatus::class);
    }

    public function appointmentType()
    {
        return $this->belongsTo(AppointmentType::class, 'appointments_type_id');
    }
}

