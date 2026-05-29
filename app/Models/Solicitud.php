<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $fillable = [
        'user_id',
        'fecha',
        'estado'
    ];

    public function medicamentos()
    {
        return $this->belongsToMany(
            Medicamento::class,
            'detalle_solicitud'
        )->withPivot('cantidad');
    }
}