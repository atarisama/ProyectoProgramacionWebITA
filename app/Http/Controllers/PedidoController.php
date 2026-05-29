<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Models\Solicitud;

class PedidoController extends Controller
{
    /**
     * Display a listing of medications available for ordering.
     */
    public function index()
    {
        $medicamentos = Medicamento::all();
        return view('pedidos.index', compact('medicamentos'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate that medications are selected and valid
        $request->validate([
            'medicamentos' => 'required|array',
            'medicamentos.*.id' => 'required|exists:medicamentos,id',
            'medicamentos.*.cantidad' => 'required|integer|min:1',
        ]);

        // 2. Create the main order request
        $solicitud = Solicitud::create([
            'user_id' => auth()->id(),
            'fecha' => now(),
            'estado' => 'Pendiente'
        ]);

        // 3. Attach medications to the order (Many-to-Many relationship)
        // Ensure you have a 'medicamentos' relationship defined in your Solicitud model
        foreach ($request->medicamentos as $item) {
            $solicitud->medicamentos()->attach($item['id'], [
                'cantidad' => $item['cantidad']
            ]);
        }

        return redirect()->back()->with('success', 'Pedido creado exitosamente.');
    }
}
