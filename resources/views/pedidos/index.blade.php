@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    
    <!-- MENÚ LATERAL -->
    <div class="w-64 bg-white shadow-md p-5 flex flex-col">
        <h1 class="text-3xl font-bold text-blue-600 tracking-wide">MediStock</h1>
        <p class="text-gray-400 text-sm mb-10 font-medium uppercase">Hospitalario</p>
        
        <nav class="space-y-2">
            <a href="{{ route('medicamentos.index') }}" 
               class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('medicamentos.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                Inventario
            </a>
            <a href="{{ route('pedidos.index') }}" 
               class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('pedidos.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                Solicitudes
            </a>
            <a href="{{ route('reportes.index') }}" 
               class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('reportes.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                Reportes
            </a>
        </nav>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="flex-1 p-10 max-w-4xl">
        
        <!-- Alertas de éxito (Feedback) -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Nueva Solicitud de Reposición</h1>
            <p class="text-gray-500 mt-1">Genera una orden para reabastecer el almacén.</p>
        </div>

        <!-- FORMULARIO -->
        <div class="bg-white rounded-xl shadow p-8 border border-gray-100">
            <form action="{{ route('pedidos.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Selección de Medicamento -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Seleccionar Medicamento o Material</label>
                    <select name="medicamentos[0][id]" 
                        class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg w-full outline-none transition bg-white @error('medicamentos.0.id') border-red-500 @enderror">
                        <option value="" disabled selected>Elija un elemento de la lista...</option>
                        @foreach($medicamentos as $medicamento)
                            <option value="{{ $medicamento->id }}" {{ old('medicamento_id') == $medicamento->id ? 'selected' : '' }}>

                                {{ $medicamento->nombre }} (Stock actual: {{ $medicamento->cantidad }} u.)
                            </option>
                        @endforeach
                    </select>
                    @error('medicamentos.0.id')
                        <p class="text-red-500 text-xs mt-1 font-medium">Debe seleccionar un medicamento válido.</p>
                    @enderror
                </div>

                <!-- Cantidad Solicitada -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Cantidad Solicitada</label>
                    <input type="number" name="medicamentos[0][cantidad]" placeholder="Ej. 50" min="1" value="{{ old('medicamentos.0.count', 1) }}"
                        class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg w-full outline-none transition @error('medicamentos.0.cantidad') border-red-500 @enderror">
                    @error('medicamentos.0.cantidad')
                        <p class="text-red-500 text-xs mt-1 font-medium">Ingrese una cantidad válida mayor a 0.</p>
                    @enderror
                </div>

                <!-- Comentarios Adicionales -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Notas o Justificación de la Solicitud (Opcional)</label>
                    <textarea name="comentarios" placeholder="Escriba aquí los detalles del porqué se requiere la reposición urgente..." rows="3"
                        class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg w-full outline-none transition">{{ old('comentarios') }}</textarea>
                </div>

                <!-- Botón de Envío -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg shadow-md transition duration-200">
                        Enviar Solicitud
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
