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
    <div class="flex-1 p-10 max-w-6xl">
        
        <!-- Alertas de éxito (Feedback) -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col gap-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800">Solicitudes</h1>
                    <p class="text-gray-500 mt-1">Revisa tus pedidos y crea nuevas solicitudes de reposición.</p>
                </div>
                <a href="#nueva-solicitud" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                    Nueva Solicitud
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">
                <div class="flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Mis Solicitudes</h2>
                        <p class="text-sm text-gray-500">Tus solicitudes recientes y su estado.</p>
                    </div>
                    <form method="GET" action="{{ route('pedidos.index') }}" class="flex items-center gap-3">
                        <label class="text-sm font-medium text-gray-700" for="status">Filtrar estado</label>
                        <select id="status" name="status" class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            <option value="">Todos</option>
                            <option value="Pendiente" {{ request('status') === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Aprobada" {{ request('status') === 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                            <option value="Rechazada" {{ request('status') === 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                        </select>
                    </form>
                </div>
                <div class="overflow-x-auto bg-white">
                    <table class="min-w-full text-left text-sm text-gray-600">
                        <thead class="border-b border-gray-200 bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-6 py-4 font-semibold">ID</th>
                                <th class="px-6 py-4 font-semibold">Medicamento o Material</th>
                                <th class="px-6 py-4 font-semibold">Cantidad</th>
                                <th class="px-6 py-4 font-semibold">Fecha</th>
                                <th class="px-6 py-4 font-semibold">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($solicitudes as $solicitud)
                                @php
                                    $itemNames = $solicitud->medicamentos->pluck('nombre')->join(', ');
                                    $totalCantidad = $solicitud->medicamentos->sum(fn($item) => $item->pivot->cantidad);
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $solicitud->id }}</td>
                                    <td class="px-6 py-4">{{ $itemNames ?: 'Sin ítems' }}</td>
                                    <td class="px-6 py-4">{{ $totalCantidad }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($solicitud->fecha)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClasses = [
                                                'Pendiente' => 'bg-yellow-100 text-yellow-800',
                                                'Aprobada' => 'bg-emerald-100 text-emerald-800',
                                                'Rechazada' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses[$solicitud->estado] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ $solicitud->estado }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        No hay solicitudes registradas aún. Crea una nueva solicitud para comenzar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-gray-100 bg-gray-50 p-4">
                    {{ $solicitudes->links() }}
                </div>
            </div>
        </div>

        <!-- FORMULARIO -->
        <div id="nueva-solicitud" class="bg-white rounded-3xl shadow p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Crear nueva solicitud</h2>
            <p class="text-gray-500 mb-6">Selecciona el medicamento o material que necesitas y envía tu pedido.</p>

            <form action="{{ route('pedidos.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Seleccionar Medicamento o Material</label>
                        <select name="medicamentos[0][id]"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('medicamentos.0.id') border-red-500 @enderror">
                            <option value="" disabled selected>Elija un elemento de la lista...</option>
                            @foreach($medicamentos as $medicamento)
                                <option value="{{ $medicamento->id }}" {{ old('medicamentos.0.id') == $medicamento->id ? 'selected' : '' }}>
                                    {{ $medicamento->nombre }} (Stock actual: {{ $medicamento->cantidad }} u.)
                                </option>
                            @endforeach
                        </select>
                        @error('medicamentos.0.id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Cantidad Solicitada</label>
                        <input type="number" name="medicamentos[0][cantidad]" min="1" value="{{ old('medicamentos.0.cantidad', 1) }}"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('medicamentos.0.cantidad') border-red-500 @enderror" />
                        @error('medicamentos.0.cantidad')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Notas o Justificación de la Solicitud (Opcional)</label>
                    <textarea name="comentarios" rows="4"
                        class="w-full rounded-3xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('comentarios') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="rounded-3xl bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-200/30 transition hover:bg-blue-700">
                        Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
