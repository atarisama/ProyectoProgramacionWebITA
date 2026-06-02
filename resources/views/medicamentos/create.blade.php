@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-10">
    
    <!-- ENCABEZADO Y REGRESAR -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Agregar medicamento</h1>
        <a href="{{ route('medicamentos.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium flex items-center gap-1">
            ← Volver al Inventario
        </a>
    </div>

    <!-- FORMULARIO -->
    <div class="bg-white rounded-xl shadow p-8 border border-gray-100">
        <form action="{{ route('medicamentos.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre del Medicamento</label>
                <input type="text" name="nombre" placeholder="Ej. Paracetamol 500mg" value="{{ old('nombre') }}"
                    class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg w-full outline-none transition @error('nombre') border-red-500 @enderror">
                @error('nombre')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción (Opcional)</label>
                <textarea name="descripcion" placeholder="Notas, indicaciones o especificaciones de almacenamiento..." rows="3"
                    class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg w-full outline-none transition @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cantidad y Fecha de Caducidad -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Cantidad -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Cantidad Inicial</label>
                    <input type="number" name="cantidad" placeholder="0" min="0" value="{{ old('cantidad') }}"
                        class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg w-full outline-none transition @error('cantidad') border-red-500 @enderror">
                    @error('cantidad')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de Caducidad -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Caducidad</label>
                    <input type="date" name="fecha_caducidad" value="{{ old('fecha_caducidad') }}"
                        class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg w-full outline-none transition @error('fecha_caducidad') border-red-500 @enderror">
                    @error('fecha_caducidad')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('medicamentos.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3 rounded-lg transition text-center">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg shadow-sm transition">
                    Guardar Medicamento
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
