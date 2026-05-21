<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    protected $table = 'detalle_solicitud';

    protected $fillable = [
        'solicitud_id',
        'medicamento_id',
        'material_id',
        'cantidad'
    ];


    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    // Relación con medicamento
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    // Relación con material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}