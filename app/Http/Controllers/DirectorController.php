<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class DirectorController extends Controller
{
    public function index()
    {
        // Vista principal del dashboard del director
        return view('director.dashboard');
    }
public function ingresos()
{
    // Datos de prueba (sin base de datos)
    $pacientes = [
        [
            'nombre' => 'Carlos Ramírez',
            'diagnostico' => 'Neumonía severa',
            'doctor' => 'Dr. Pérez',
            'monto' => 2500,
            'estado' => 'Hospitalizado',
        ],
        [
            'nombre' => 'María López',
            'diagnostico' => 'Fractura de pierna',
            'doctor' => 'Dra. Sánchez',
            'monto' => 1800,
            'estado' => 'Alta',
        ],
        [
            'nombre' => 'José Hernández',
            'diagnostico' => 'Covid-19',
            'doctor' => 'Dr. Gómez',
            'monto' => 3200,
            'estado' => 'Hospitalizado',
        ],
    ];

    return view('director.ingresos', compact('pacientes'));
}


}
