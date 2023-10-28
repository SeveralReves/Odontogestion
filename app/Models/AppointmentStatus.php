<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'appointment_status'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'type'
    ];

    protected $dates = ['deleted_at']; // Indica que la columna deleted_at es de tipo fecha

    // Otras definiciones, relaciones, métodos, etc., según sea necesario para tu aplicación
}