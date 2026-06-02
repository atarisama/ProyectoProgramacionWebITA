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
    public function index(Request $request)
    {
        $medicamentos = Medicamento::all();

        $solicitudesQuery = auth()->user()
            ->solicitudes()
            ->with('medicamentos')
            ->orderByDesc('fecha');

        if ($request->filled('status')) {
            $solicitudesQuery->where('estado', $request->status);
        }

        $solicitudes = $solicitudesQuery->paginate(10)->withQueryString();

        return view('pedidos.index', compact('medicamentos', 'solicitudes'));
    }

    /**
     * Display the director's view of all orders with search and filters.
     */
    public function directorIndex(Request $request)
    {
        $buscarId = $request->query('search_id');
        $fecha = $request->query('fecha');
        $estado = $request->query('status');

        $solicitudesQuery = Solicitud::with(['medicamentos', 'user'])
            ->orderByDesc('fecha');

        if ($buscarId) {
            $solicitudesQuery->where('id', $buscarId);
        }

        if ($fecha) {
            $solicitudesQuery->whereDate('fecha', $fecha);
        }

        if ($estado) {
            $solicitudesQuery->where('estado', $estado);
        }

        $solicitudes = $solicitudesQuery->paginate(10)->withQueryString();

        return view('director.pedidos', compact('solicitudes', 'buscarId', 'fecha', 'estado'));
    }

    /**
     * Update the status of a director order.
     */
    public function directorUpdateStatus(Request $request, Solicitud $solicitud)
    {
        $validated = $request->validate([
            'status' => 'required|in:Aprobada,Rechazada',
        ]);

        $solicitud->update(['estado' => $validated['status']]);

        return redirect()->route('director.pedidos')->with('success', 'Solicitud actualizada a ' . $validated['status'] . '.');
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
