<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $fillable = [
        'nombre_paciente',
        'nombre_doctor',
        'enfermedad',
        'monto',
        'estado'
    ];
}
