<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos = Ingreso::latest()->get();
        
        return view('director.ingresos', compact('ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_paciente' => 'required|string|max:255',
            'nombre_doctor' => 'required|string|max:255',
            'enfermedad' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'estado' => 'required|in:Hospitalizado,Dado de Alta'
        ]);

        Ingreso::create($validated);

        return redirect()->route('director.ingresos')->with('success', 'Ingreso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        $validated = $request->validate([
            'nombre_paciente' => 'required|string|max:255',
            'nombre_doctor' => 'required|string|max:255',
            'enfermedad' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'estado' => 'required|in:Hospitalizado,Dado de Alta'
        ]);

        $ingreso->update($validated);

        return redirect()->route('director.ingresos')->with('success', 'Ingreso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();

        return redirect()->route('director.ingresos')->with('success', 'Ingreso eliminado exitosamente.');
    }
}
