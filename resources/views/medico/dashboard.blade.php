@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
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

    <div class="flex-1 p-10">
        <div class="bg-white rounded-3xl shadow border border-gray-200 p-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-blue-600 font-semibold">Panel Médico</p>
                    <h1 class="mt-4 text-4xl font-bold text-gray-900">Bienvenido, {{ auth()->user()->name }}</h1>
                    <p class="mt-2 text-gray-600">Gestiona solicitudes, consulta inventario y revisa reportes desde aquí.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('pedidos.index') }}" class="inline-flex items-center rounded-full bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition">
                        Ver Solicitudes
                    </a>
                    <a href="{{ route('reportes.index') }}" class="inline-flex items-center rounded-full border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition">
                        Ver Reportes
                    </a>
                </div>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Solicitudes activas</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900">Revisa y responde</p>
                    <p class="mt-2 text-sm text-gray-500">Atiende las solicitudes de los usuarios y mantén el flujo de trabajo al día.</p>
                </div>
                <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Inventario</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900">Control de stock</p>
                    <p class="mt-2 text-sm text-gray-500">Consulta el stock disponible y gestiona las necesidades del personal.</p>
                </div>
                <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Reportes</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900">Datos de movimiento</p>
                    <p class="mt-2 text-sm text-gray-500">Consulta métricas de ingresos, gastos y solicitudes para la toma de decisiones.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
