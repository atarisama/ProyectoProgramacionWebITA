@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <!-- Menú lateral -->
    <div class="w-64 bg-white shadow-md p-5 flex flex-col">
        <h1 class="text-3xl font-bold text-blue-600 tracking-wide">MediStock</h1>
        <p class="text-gray-400 text-sm mb-10 font-medium uppercase">Hospitalario</p>

        <nav class="space-y-2">
            <a href="{{ route('director.pedidos') }}"
               class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('director.pedidos') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                Pedidos
            </a>
            <a href="{{ route('director.reportes') }}"
               class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('director.reportes') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                Reportes
            </a>
            <a href="{{ route('director.ingresos') }}"
               class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('director.ingresos') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                Ingresos
            </a>
        </nav>
    </div>

    <!-- Contenido principal -->
    <div class="flex-1 p-10">
        <div class="bg-white rounded-3xl shadow border border-gray-200 p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-blue-600 font-semibold">Panel Director</p>
                    <h1 class="mt-2 text-3xl font-bold text-gray-900">Ingresos de Pacientes</h1>
                    <p class="mt-1 text-gray-600">Consulta y administra los ingresos hospitalarios.</p>
                </div>
                <a href="#"
                   class="inline-flex items-center rounded-full bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition">
                   Añadir nuevo
                </a>
            </div>

            <!-- Tabla de pacientes -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Paciente</th>
                            <th class="px-4 py-2 text-left">Diagnóstico</th>
                            <th class="px-4 py-2 text-left">Doctor</th>
                            <th class="px-4 py-2 text-left">Monto</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $paciente['nombre'] }}</td>
                                <td class="px-4 py-2">{{ $paciente['diagnostico'] }}</td>
                                <td class="px-4 py-2">{{ $paciente['doctor'] }}</td>
                                <td class="px-4 py-2">${{ number_format($paciente['monto'], 2) }}</td>
                                <td class="px-4 py-2">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $paciente['estado'] === 'Hospitalizado' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                        {{ $paciente['estado'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
