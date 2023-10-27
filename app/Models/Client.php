<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clients'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'birthday',
        'address',
        'email',
        'id_number',
    ];

    protected $dates = ['deleted_at']; // Indica que la columna deleted_at es de tipo fecha

    // Otras definiciones, relaciones, métodos, etc., según sea necesario para tu aplicación
}
