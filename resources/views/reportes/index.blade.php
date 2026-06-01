@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <!-- MENÚ LATERAL -->
    <div class="w-64 bg-white shadow-md p-5 flex flex-col">
        <h1 class="text-3xl font-bold text-blue-600 tracking-wide">MediStock</h1>
        <p class="text-gray-400 text-sm mb-10 font-medium uppercase">Hospitalario</p>

        @php $isDirector = auth()->user()?->rol === 'director'; @endphp
        <nav class="space-y-2">
            @if($isDirector)
                <a href="{{ route('director.dashboard') }}"
                   class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('director.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                    Dashboard
                </a>
                <a href="{{ route('director.pedidos') }}"
                   class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('director.pedidos') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                    Pedidos
                </a>
                <a href="{{ route('director.reportes') }}"
                   class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('director.reportes') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                    Reportes
                </a>
            @else
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
            @endif
        </nav>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="flex-1 p-10">
        <div class="flex flex-col gap-6 mb-8 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Reportes</h1>
                <p class="text-gray-500 mt-2">En esta ventana se muestra un panorama general del hospital con gráficos por Gastos, Ingresos y Solicitudes.</p>
            </div>
            <div class="rounded-full border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm">
                Última actualización: {{ now()->format('d/m/Y H:i') }}
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">
            <div class="flex flex-col gap-3 p-6 border-b border-gray-100 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.24em] text-blue-600 font-semibold">Reportes</p>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $chartTitle }}</h2>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ $isDirector ? route('director.reportes', ['tab' => 'gastos']) : route('reportes.index', ['tab' => 'gastos']) }}"
                       class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $activeTab === 'gastos' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Gastos
                    </a>
                    <a href="{{ $isDirector ? route('director.reportes', ['tab' => 'ingresos']) : route('reportes.index', ['tab' => 'ingresos']) }}"
                       class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $activeTab === 'ingresos' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Ingresos
                    </a>
                    <a href="{{ $isDirector ? route('director.reportes', ['tab' => 'solicitudes']) : route('reportes.index', ['tab' => 'solicitudes']) }}"
                       class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $activeTab === 'solicitudes' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Solicitudes
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="grid gap-6 xl:grid-cols-[1.7fr_0.8fr]">
                    <div class="rounded-3xl bg-white p-6 text-slate-900 shadow-lg overflow-hidden relative border border-blue-100">
                        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-blue-600">{{ $chartTitle }}</p>
                                <h3 class="text-3xl font-bold">
                                    @if($activeTab === 'solicitudes')
                                        {{ number_format($totalSolicitudes, 0, ',', '.') }} solicitudes
                                    @elseif($activeTab === 'ingresos')
                                        ${{ number_format($totalIngresos, 0, ',', '.') }}
                                    @else
                                        ${{ number_format($totalGastos, 0, ',', '.') }}
                                    @endif
                                </h3>
                            </div>
                            <div class="rounded-full bg-blue-600 px-4 py-2 text-sm text-white">{{ ucfirst($activeTab) }}</div>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div class="space-y-3">
                                <p class="text-sm text-slate-500">Gráfica de barras para identificar tendencias.</p>
                                <div class="space-y-4">
                                    @foreach($months as $index => $month)
                                        <div class="flex items-center gap-3">
                                            <span class="w-12 text-xs text-blue-600">{{ $month }}</span>
                                            <div class="h-3 flex-1 rounded-full bg-blue-100 overflow-hidden">
                                                <div class="h-full rounded-full bg-gradient-to-r from-blue-700 to-blue-400"
                                                     style="width: {{ ($monthlyTotals[$index] / max($monthlyTotals->max(), 1)) * 100 }}%;"></div>
                                            </div>
                                            <span class="w-24 text-right text-xs text-slate-700">
                                                @if($activeTab === 'solicitudes')
                                                    {{ number_format($monthlyTotals[$index], 0, ',', '.') }}
                                                @else
                                                    ${{ number_format($monthlyTotals[$index], 0, ',', '.') }}
                                                @endif
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="rounded-3xl bg-blue-50 p-4 border border-blue-100">
                                    <p class="text-xs uppercase tracking-[0.24em] text-blue-600">Tendencia</p>
                                    <p class="mt-3 text-xl font-bold capitalize text-slate-900">{{ $trendStatus }}</p>
                                    <p class="text-sm text-slate-500 mt-1">Compara el desempeño del período actual.</p>
                                </div>
                                <div class="rounded-3xl bg-blue-50 p-4 border border-blue-100">
                                    <p class="text-xs uppercase tracking-[0.24em] text-blue-600">Período</p>
                                    <p class="mt-3 text-xl font-bold text-slate-900">{{ $periodStartLabel }} - {{ $periodEndLabel }}</p>
                                    <p class="text-sm text-slate-500 mt-1">Navega entre diferentes ventanas de tiempo.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-col gap-3 border-t border-slate-800 pt-4 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-sm text-slate-400">Paginación para recorrer períodos o conjuntos de datos.</p>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('reportes.index', ['tab' => $activeTab, 'page' => max(1, $page - 1)]) }}"
                                   class="inline-flex items-center rounded-full border border-slate-700 bg-slate-900 px-3 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-800 {{ $page <= 1 ? 'opacity-40 cursor-not-allowed' : '' }}"
                                   @if($page <= 1) aria-disabled="true" @endif>
                                    ‹ Anterior
                                </a>
                                <a href="{{ route('reportes.index', ['tab' => $activeTab, 'page' => $page + 1]) }}"
                                   class="inline-flex items-center rounded-full border border-slate-700 bg-slate-900 px-3 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-800">
                                    Siguiente ›
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4">
                        <div class="rounded-3xl bg-white p-5 border border-gray-100 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.24em] text-gray-500">Total solicitudes</p>
                            <h3 class="mt-3 text-3xl font-bold text-gray-900">{{ $totalSolicitudes }}</h3>
                            <p class="mt-2 text-sm text-gray-500">Solicitudes registradas</p>
                        </div>
                        <div class="rounded-3xl bg-white p-5 border border-gray-100 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.24em] text-gray-500">Ingresos totales</p>
                            <h3 class="mt-3 text-3xl font-bold text-emerald-700">${{ number_format($totalIngresos, 0, ',', '.') }}</h3>
                            <p class="mt-2 text-sm text-gray-500">Movimientos de entrada</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid gap-6 xl:grid-cols-3">
                    <div class="xl:col-span-2 rounded-3xl bg-white border border-gray-100 p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $activeTab === 'solicitudes' ? 'Últimas solicitudes' : 'Movimientos recientes' }}</h3>
                                <p class="text-sm text-gray-500">Resumen rápido del estado actual.</p>
                            </div>
                        </div>

                        @if($activeTab === 'solicitudes')
                            <div class="space-y-4">
                                @forelse($solicitudes as $solicitud)
                                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-4 flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">Solicitud #{{ $solicitud->id }}</p>
                                            <p class="text-xs text-gray-500">Fecha: {{ \Carbon\Carbon::parse($solicitud->fecha)->format('d/m/Y') }}</p>
                                        </div>
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $solicitud->estado === 'Aprobada' ? 'bg-emerald-100 text-emerald-800' : ($solicitud->estado === 'Pendiente' ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $solicitud->estado }}
                                        </span>
                                    </div>
                                @empty
                                    <div class="rounded-3xl border border-dashed border-gray-300 p-6 text-center text-gray-500">
                                        No hay solicitudes recientes.
                                    </div>
                                @endforelse
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm text-gray-600">
                                    <thead class="border-b border-gray-200 bg-gray-50 text-gray-700">
                                        <tr>
                                            <th class="px-4 py-3">Tipo</th>
                                            <th class="px-4 py-3">Descripción</th>
                                            <th class="px-4 py-3">Cantidad</th>
                                            <th class="px-4 py-3">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @forelse($movimientos as $mov)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-4 py-4 font-semibold text-gray-800">{{ ucfirst($mov->tipo) }}</td>
                                                <td class="px-4 py-4 text-gray-600">{{ $mov->medicamento?->nombre ?? $mov->material?->nombre ?? 'N/A' }}</td>
                                                <td class="px-4 py-4">{{ $mov->cantidad }}</td>
                                                <td class="px-4 py-4 text-gray-500">{{ \Carbon\Carbon::parse($mov->fecha)->format('d/m/Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="p-6 text-center text-gray-400">No hay movimientos registrados.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="rounded-3xl bg-white border border-gray-100 p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Resumen rápido</h3>
                        <div class="space-y-4">
                            <div class="rounded-3xl bg-blue-50 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-blue-600">Inventario total</p>
                                <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalMedicamentos }}</p>
                            </div>
                            <div class="rounded-3xl bg-amber-50 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-amber-700">Stock bajo</p>
                                <p class="mt-2 text-2xl font-bold text-amber-800">{{ $stockBajo }}</p>
                            </div>
                            <div class="rounded-3xl bg-red-50 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-red-600">Sin stock</p>
                                <p class="mt-2 text-2xl font-bold text-red-700">{{ $sinStock }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
