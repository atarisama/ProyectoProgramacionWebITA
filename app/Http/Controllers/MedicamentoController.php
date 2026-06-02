<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;

class MedicamentoController extends Controller
{
    /**
     * Muestra la lista de medicamentos (con opción de búsqueda).
     */
    public function index(Request $request)
    {
        // Captura lo que el usuario escribió en el cuadro de búsqueda
        $buscar = $request->input('buscar');

        // Consulta a la base de datos usando Eloquent
        // Si hay texto, filtra por nombre; si está vacío, trae todos los registros
        $medicamentos = Medicamento::when($buscar, function ($query, $buscar) {
            return $query->where('nombre', 'LIKE', "%{$buscar}%");
        })->get();

        return view('medicamentos.index', compact('medicamentos'));
    }

    /**
     * Muestra el formulario para crear un nuevo medicamento.
     */
    public function create()
    {
        return view('medicamentos.create');
    }

    /**
     * Almacena un medicamento en la base de datos con validación previa.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
            'fecha_caducidad' => 'required|date',
        ]);

        Medicamento::create($validated);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento creado con éxito.');
    }

    /**
     * Muestra el formulario de edición usando Route Model Binding.
     */
    public function edit(Medicamento $medicamento)
    {
        return view('medicamentos.edit', compact('medicamento'));
    }

    /**
     * Actualiza el medicamento con validación previa.
     */
    public function update(Request $request, Medicamento $medicamento)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
            'fecha_caducidad' => 'required|date',
        ]);

        $medicamento->update($validated);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado con éxito.');
    }

    /**
     * Elimina el medicamento de la base de datos.
     */
    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado con éxito.');
    }
}
