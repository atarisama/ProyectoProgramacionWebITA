<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol'
    ];

    //Un usuario tiene muchas solicitudes, por eso el hasmany
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}
