<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
     protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'fecha_caducidad'
    ];

    // Aparece en detalles de solicitud
    public function detalles()
    {
        return $this->hasMany(DetalleSolicitud::class);
    }

    // Tiene movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
