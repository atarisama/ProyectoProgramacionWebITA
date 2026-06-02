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
            <a href="{{ route('director.ingresos') }}"
               class="flex items-center p-3 rounded-lg font-semibold {{ request()->routeIs('director.ingresos') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                Ingresos
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
                    <h1 class="text-4xl font-bold text-gray-900">Ingresos</h1>
                    <p class="text-gray-500 mt-2">Gestiona los ingresos y hospitalizaciones de los pacientes.</p>
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

        <!-- FORMULARIO PARA AGREGAR NUEVO INGRESO -->
        <div class="bg-white rounded-3xl shadow border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Añadir Nuevo Ingreso</h2>
            <form method="POST" action="{{ route('director.ingresos.store') }}" class="grid gap-6 md:grid-cols-2 lg:grid-cols-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del Paciente</label>
                    <input type="text" name="nombre_paciente" value="{{ old('nombre_paciente') }}"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                        placeholder="Ej: Juan Pérez" required />
                    @error('nombre_paciente')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Doctor</label>
                    <input type="text" name="nombre_doctor" value="{{ old('nombre_doctor') }}"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                        placeholder="Ej: Dr. Carlos López" required />
                    @error('nombre_doctor')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Enfermedad</label>
                    <input type="text" name="enfermedad" value="{{ old('enfermedad') }}"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                        placeholder="Ej: Neumonía" required />
                    @error('enfermedad')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Monto a Cobrar</label>
                    <input type="number" name="monto" value="{{ old('monto') }}" step="0.01"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                        placeholder="0.00" required />
                    @error('monto')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                    <select name="estado" class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                        <option value="Hospitalizado" {{ old('estado') == 'Hospitalizado' ? 'selected' : '' }}>Hospitalizado</option>
                        <option value="Dado de Alta" {{ old('estado') == 'Dado de Alta' ? 'selected' : '' }}>Dado de Alta</option>
                    </select>
                    @error('estado')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2 lg:col-span-5 flex justify-end">
                    <button type="submit" class="inline-flex items-center rounded-full bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                        Agregar Ingreso
                    </button>
                </div>
            </form>
        </div>

        <!-- TABLA DE INGRESOS -->
        <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between gap-4 p-6 border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Ingresos Registrados</h2>
                    <p class="text-sm text-gray-500">Lista de todos los pacientes hospitalizados.</p>
                </div>
                <span class="rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">{{ $ingresos->count() }} Ingresos</span>
            </div>
            <div class="overflow-x-auto bg-white">
                <table class="min-w-full text-left text-sm text-gray-600">
                    <thead class="border-b border-gray-200 bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Paciente</th>
                            <th class="px-6 py-4 font-semibold">Doctor</th>
                            <th class="px-6 py-4 font-semibold">Enfermedad</th>
                            <th class="px-6 py-4 font-semibold">Monto</th>
                            <th class="px-6 py-4 font-semibold">Estado</th>
                            <th class="px-6 py-4 font-semibold">Fecha</th>
                            <th class="px-6 py-4 font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($ingresos as $ingreso)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $ingreso->nombre_paciente }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $ingreso->nombre_doctor }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $ingreso->enfermedad }}</td>
                                <td class="px-6 py-4 text-gray-700 font-semibold">{{ number_format($ingreso->monto, 2) }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'Hospitalizado' => 'bg-yellow-100 text-yellow-800',
                                            'Dado de Alta' => 'bg-emerald-100 text-emerald-800',
                                        ];
                                    @endphp
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses[$ingreso->estado] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $ingreso->estado }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $ingreso->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <!-- Botón Editar -->
                                        <button onclick="editIngreso({{ json_encode($ingreso) }})" 
                                            class="inline-flex items-center rounded-full bg-blue-600 px-3 py-1 text-xs font-semibold text-white hover:bg-blue-700 transition">
                                            Editar
                                        </button>
                                        <!-- Botón Eliminar -->
                                        <form method="POST" action="{{ route('director.ingresos.destroy', $ingreso) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Está seguro que desea eliminar este ingreso?')" 
                                                class="inline-flex items-center rounded-full bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700 transition">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">No hay ingresos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA EDITAR INGRESO -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl shadow-lg p-8 w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Editar Ingreso</h2>
        <form id="editForm" method="POST" class="grid gap-6 md:grid-cols-2">
            @csrf
            @method('PATCH')
            
            <div class="md:col-span-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del Paciente</label>
                <input type="text" id="editNombrePaciente" name="nombre_paciente" 
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                    required />
            </div>

            <div class="md:col-span-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Doctor</label>
                <input type="text" id="editNombreDoctor" name="nombre_doctor" 
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                    required />
            </div>

            <div class="md:col-span-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Enfermedad</label>
                <input type="text" id="editEnfermedad" name="enfermedad" 
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                    required />
            </div>

            <div class="md:col-span-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Monto</label>
                <input type="number" id="editMonto" name="monto" step="0.01" 
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                    required />
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                <select id="editEstado" name="estado" 
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" 
                    required>
                    <option value="Hospitalizado">Hospitalizado</option>
                    <option value="Dado de Alta">Dado de Alta</option>
                </select>
            </div>

            <div class="md:col-span-2 flex gap-4 justify-end">
                <button type="button" onclick="closeEditModal()" 
                    class="inline-flex items-center rounded-full border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button type="submit" 
                    class="inline-flex items-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function editIngreso(ingreso) {
        document.getElementById('editNombrePaciente').value = ingreso.nombre_paciente;
        document.getElementById('editNombreDoctor').value = ingreso.nombre_doctor;
        document.getElementById('editEnfermedad').value = ingreso.enfermedad;
        document.getElementById('editMonto').value = ingreso.monto;
        document.getElementById('editEstado').value = ingreso.estado;
        
        const form = document.getElementById('editForm');
        form.action = `/director/ingresos/${ingreso.id}`;
        
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Cerrar modal al hacer clic fuera
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>
@endsection
