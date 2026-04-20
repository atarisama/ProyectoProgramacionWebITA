<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'medicamento_id',
        'material_id',
        'cantidad',
        'fecha'
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}