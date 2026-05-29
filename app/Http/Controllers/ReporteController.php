<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Genera la vista de reportes con métricas clave y filtros de inventario.
     */
    public function index(Request $request)
    {
        // 1. Obtener todos los medicamentos básicos
        $medicamentos = Medicamento::all();

        // 2. Métricas rápidas para paneles o estadísticas superiores
        $totalMedicamentos = $medicamentos->count();
        $sinStock = Medicamento::where('cantidad', 0)->count();
        $stockBajo = Medicamento::where('cantidad', '>', 0)->where('cantidad', '<=', 10)->count();

        // 3. Opcional: Medicamentos próximos a vencer (últimos 3 meses del año actual)
        $proximosAvencer = Medicamento::where('fecha_caducidad', '<=', now()->addMonths(3))
                                      ->where('fecha_caducidad', '>=', now())
                                      ->get();

        return view('reportes.index', compact(
            'medicamentos', 
            'totalMedicamentos', 
            'sinStock', 
            'stockBajo', 
            'proximosAvencer'
        ));
    }
}
