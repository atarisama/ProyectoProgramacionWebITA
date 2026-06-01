@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <!-- MENÚ LATERAL -->
    <div class="w-64 bg-white shadow-md p-5 flex flex-col">
        <h1 class="text-3xl font-bold text-blue-600 tracking-wide">MediStock</h1>
        <p class="text-gray-400 text-sm mb-10 font-medium uppercase">Hospitalario</p>

        <nav class="space-y-2">
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
        </nav>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="flex-1 p-10 max-w-7xl mx-auto">
        <div class="flex flex-col gap-4 mb-8">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Pedidos</h1>
                    <p class="text-gray-500 mt-2">Centro de operaciones para revisar y autorizar las solicitudes de todo el personal.</p>
                </div>
                <div class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm border border-gray-200">
                    {{ auth()->user()->name }} · <span class="text-blue-600">Director</span>
                </div>
            </div>
            @if(session('success'))
                <div class="rounded-3xl border border-emerald-100 bg-emerald-50 p-4 text-sm text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="bg-white rounded-3xl shadow border border-gray-100 p-6 mb-8">
            <div class="grid gap-4 lg:grid-cols-[1.5fr_1fr_1fr]">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="search_id">Buscar por ID</label>
                    <input id="search_id" name="search_id" type="text" value="{{ old('search_id', $buscarId ?? '') }}"
                        form="director-search"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="fecha">Fecha</label>
                    <input id="fecha" name="fecha" type="date" value="{{ old('fecha', $fecha ?? '') }}"
                        form="director-search"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="status">Filtros</label>
                    <select id="status" name="status" form="director-search"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Todos los estados</option>
                        <option value="Pendiente" {{ ($estado ?? '') === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Aprobada" {{ ($estado ?? '') === 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                        <option value="Rechazada" {{ ($estado ?? '') === 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <form id="director-search" method="GET" action="{{ route('director.pedidos') }}"></form>
                <button type="submit" form="director-search" class="inline-flex items-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                    Buscar
                </button>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between gap-4 p-6 border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Pedidos del personal</h2>
                    <p class="text-sm text-gray-500">Gestiona las solicitudes recibidas y decide su autorización.</p>
                </div>
                <span class="rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">Vista Director</span>
            </div>
            <div class="overflow-x-auto bg-white">
                <table class="min-w-full text-left text-sm text-gray-600">
                    <thead class="border-b border-gray-200 bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-semibold">ID</th>
                            <th class="px-6 py-4 font-semibold">Solicitante</th>
                            <th class="px-6 py-4 font-semibold">Solicitud</th>
                            <th class="px-6 py-4 font-semibold">Cantidad</th>
                            <th class="px-6 py-4 font-semibold">Fecha</th>
                            <th class="px-6 py-4 font-semibold">Estado</th>
                            <th class="px-6 py-4 font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($solicitudes as $solicitud)
                            @php
                                $itemNames = $solicitud->medicamentos->pluck('nombre')->join(', ');
                                $totalCantidad = $solicitud->medicamentos->sum(fn($item) => $item->pivot->cantidad);
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $solicitud->id }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $solicitud->user->name ?? 'Sin usuario' }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $itemNames ?: 'Sin ítems' }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $totalCantidad }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($solicitud->fecha)->format('d/m/Y') }}</td>
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
                                <td class="px-6 py-4">
                                    @if($solicitud->estado === 'Pendiente')
                                    <div class="flex flex-wrap gap-2">
                                        <form method="POST" action="{{ route('director.pedidos.status', $solicitud) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Aprobada">
                                            <button type="submit" class="inline-flex items-center rounded-full bg-emerald-600 px-3 py-1 text-xs font-semibold text-white hover:bg-emerald-700 transition">
                                                Autorizar
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('director.pedidos.status', $solicitud) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Rechazada">
                                            <button type="submit" class="inline-flex items-center rounded-full bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700 transition">
                                                Rechazar
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <span class="text-xs text-gray-500">Sin acción</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">No se encontraron pedidos con esos filtros.</td>
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
</div>
@endsection
