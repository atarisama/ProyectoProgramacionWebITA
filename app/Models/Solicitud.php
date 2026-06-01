<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $fillable = [
        'user_id',
        'fecha',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicamentos()
    {
        return $this->belongsToMany(
            Medicamento::class,
            'detalle_solicitud'
        )->withPivot('cantidad');
    }
}