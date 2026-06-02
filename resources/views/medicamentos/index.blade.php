@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    
    <!-- MENÚ LATERAL -->
    <div class="w-64 bg-white shadow-md p-5 flex flex-col">
        <h1 class="text-3xl font-bold text-blue-600 tracking-wide">
            MediStock
        </h1>

        <p class="text-gray-400 text-sm mb-10 font-medium uppercase">
            Hospitalario
        </p>
        
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



    <!-- CONTENIDO -->
    <div class="flex-1 p-10">
        
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif


        <!-- TITULO -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-4xl font-bold text-gray-800">
                    Panel de Inventario
                </h1>

                <p class="text-gray-500 mt-1">
                    Gestiona el stock actual de medicamentos.
                </p>
            </div>

            <a href="{{ route('medicamentos.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg shadow transition duration-200">

                + Agregar medicamento

            </a>

        </div>



        <!-- TABLA -->
        <div class="bg-white rounded-xl shadow overflow-hidden p-6">

            <!-- BUSCADOR CONECTADO AL SERVIDOR -->
            <div class="mb-6">
                <form action="{{ route('medicamentos.index') }}" method="GET" class="flex gap-2">
                    <input type="text"
                           name="buscar"
                           value="{{ request('buscar') }}"
                           placeholder="Buscar medicamento por nombre..."
                           class="border border-gray-300 p-3 rounded-lg w-full outline-none focus:ring-2 focus:ring-blue-500">
                    
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-lg font-medium transition">
                        Buscar
                    </button>

                    @if(request('buscar'))
                        <a href="{{ route('medicamentos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 rounded-lg font-medium flex items-center justify-center transition">
                            Limpiar
                        </a>
                    @endif
                </form>
            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left border-collapse">

                    <thead>

                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm font-semibold uppercase">

                            <th class="p-4">Nombre</th>

                            <th class="p-4 text-center">
                                Cantidad
                            </th>

                            <th class="p-4 text-center">
                                Estado
                            </th>

                            <th class="p-4 text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100 text-gray-700">

                        @forelse($medicamentos as $medicamento)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="p-4 font-medium text-gray-900">
                                {{ $medicamento->nombre }}
                            </td>

                            <td class="p-4 text-center">
                                {{ $medicamento->cantidad }}
                            </td>


                            <td class="p-4 text-center">

                                @if($medicamento->cantidad <= 5)

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                        Agotándose
                                    </span>

                                @elseif($medicamento->cantidad <= 15)

                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold">
                                        Bajo stock
                                    </span>

                                @else

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                        En stock
                                    </span>

                                @endif

                            </td>



                            <!-- ACCIONES -->
                            <td class="p-4 text-center space-x-2">

                                <a href="{{ route('medicamentos.edit', $medicamento) }}" 
                                   class="inline-block bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium px-3 py-1.5 rounded transition">

                                    Editar

                                </a>



                                <form action="{{ route('medicamentos.destroy', $medicamento) }}" 
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este medicamento?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-3 py-1.5 rounded transition">

                                        Eliminar

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4"
                                class="p-8 text-center text-gray-400">

                                No se encontraron medicamentos con ese nombre.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>
@endsection
