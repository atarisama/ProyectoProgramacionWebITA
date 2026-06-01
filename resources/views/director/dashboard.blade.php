@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
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

    <div class="flex-1 p-10">
        <div class="bg-white rounded-3xl shadow border border-gray-200 p-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-blue-600 font-semibold">Panel Director</p>
                    <h1 class="mt-4 text-4xl font-bold text-gray-900">Bienvenido, Director</h1>
                    <p class="mt-2 text-gray-600">Aquí puedes ver las secciones principales y acceder rápidamente a tus pedidos y reportes.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('director.pedidos') }}" class="inline-flex items-center rounded-full bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition">
                        Ir a Pedidos
                    </a>
                    <a href="{{ route('director.reportes') }}" class="inline-flex items-center rounded-full border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition">
                        Ver Reportes
                    </a>
                </div>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Pedidos pendientes</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900">Revisión inmediata</p>
                    <p class="mt-2 text-sm text-gray-500">Autoriza o rechaza solicitudes desde el panel de pedidos.</p>
                </div>
                <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Reportes</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900">Monitorea el flujo</p>
                    <p class="mt-2 text-sm text-gray-500">Consulta gastos, ingresos y solicitudes para tomar decisiones.</p>
                </div>
                <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Acceso rápido</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900">Todo en un solo lugar</p>
                    <p class="mt-2 text-sm text-gray-500">Navega entre secciones con el menú lateral.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
