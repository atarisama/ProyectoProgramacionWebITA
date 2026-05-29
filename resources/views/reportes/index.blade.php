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
    <div class="flex-1 p-10">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Reportes e Indicadores</h1>
            <p class="text-gray-500 mt-1">Análisis de niveles de existencias y alertas críticas de caducidad.</p>
        </div>

        <!-- TARJETAS DE MÉTRICAS RÁPIDAS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Total Medicamentos -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <span class="text-sm font-semibold text-gray-400 uppercase">Total Catálogo</span>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalMedicamentos }}</h3>
                </div>
                <p class="text-xs text-gray-500 mt-4">Medicamentos registrados</p>
            </div>

            <!-- Stock Bajo -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <span class="text-sm font-semibold text-yellow-600 uppercase">Stock Bajo (≤ 10u)</span>
                    <h3 class="text-3xl font-bold text-yellow-600 mt-1">{{ $stockBajo }}</h3>
                </div>
                <p class="text-xs text-yellow-500 mt-4">Requieren revisión pronto</p>
            </div>

            <!-- Agotados -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <span class="text-sm font-semibold text-red-600 uppercase">Sin Stock (0u)</span>
                    <h3 class="text-3xl font-bold text-red-600 mt-1">{{ $sinStock }}</h3>
                </div>
                <p class="text-xs text-red-500 mt-4">Generar solicitud urgente</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- TABLA PRINCIPAL DE EXISTENCIAS -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden p-6 lg:col-span-2 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2"> Inventario General</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs font-semibold uppercase tracking-wider">
                                <th class="p-3">Medicamento</th>
                                <th class="p-3 text-center">Cantidad Actual</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                            @forelse($medicamentos as $medicamento)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-3 font-medium text-gray-900">{{ $medicamento->nombre }}</td>
                                    <td class="p-3 text-center">
                                        <span class="font-mono font-bold {{ $medicamento->cantidad <= 10 ? 'text-amber-600' : 'text-gray-700' }}">
                                            {{ $medicamento->cantidad }} u.
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="p-4 text-center text-gray-400">No hay datos que mostrar</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SECCIÓN DE PRÓXIMOS A VENCER -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-red-600 mb-4 flex items-center gap-2">Alerta de Caducidad</h2>
                <p class="text-xs text-gray-400 mb-4 font-medium">Vencimientos en los próximos 3 meses:</p>
                
                <div class="space-y-3 max-h-96 overflow-y-auto pr-1">
                    @forelse($proximosAvencer as $item)
                        <div class="p-3 bg-red-50 border border-red-100 rounded-lg flex justify-between items-center">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800">{{ $item->nombre }}</h4>
                                <p class="text-xs text-red-600 font-medium mt-0.5">
                                    Vence: {{ \Carbon\Carbon::parse($item->fecha_caducidad)->format('d/m/Y') }}
                                </p>
                            </div>
                            <span class="text-xs bg-white text-red-700 border border-red-200 px-2 py-1 rounded font-mono font-bold">
                                {{ $item->cantidad }} u.
                            </span>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-400 border border-dashed border-gray-200 rounded-lg">
                             No hay medicamentos próximos a vencer.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
