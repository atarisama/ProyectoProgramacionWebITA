@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-10">

    <div class="bg-white shadow-lg rounded-xl p-8">

        <h1 class="text-3xl font-bold mb-6">
            Editar medicamento
        </h1>

        <form action="{{ route('medicamentos.update', $medicamento->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Nombre
                </label>

                <input type="text"
                       name="nombre"
                       value="{{ $medicamento->nombre }}"
                       class="border p-3 rounded w-full">

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Descripción
                </label>

                <textarea name="descripcion"
                          class="border p-3 rounded w-full">{{ $medicamento->descripcion }}</textarea>

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Cantidad
                </label>

                <input type="number"
                       name="cantidad"
                       value="{{ $medicamento->cantidad }}"
                       class="border p-3 rounded w-full">

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Fecha de caducidad
                </label>

                <input type="date"
                       name="fecha_caducidad"
                       value="{{ $medicamento->fecha_caducidad }}"
                       class="border p-3 rounded w-full">

            </div>

            <div class="flex gap-4">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                    Actualizar

                </button>

                <a href="{{ route('medicamentos.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

@endsection