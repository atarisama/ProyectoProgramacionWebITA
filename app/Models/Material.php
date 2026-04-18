<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad'
    ];
    //lo tenemos en detalles de solicitud 
    public function detalles()
    {
        return $this->hasMany(DetalleSolicitud::class);
    }
    
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
