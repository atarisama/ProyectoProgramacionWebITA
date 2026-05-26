<x-guest-layout>

 {{--vista de loging similar al wireframe--}}
 
<form method="POST" action="{{ route('login') }}"
      class="bg-white rounded-2xl p-10 w-full max-w-md border border-gray-100">
    @csrf
    <div class="text-center mb-8">
        <div class="text-5xl mb-3">

        </div>
        <h1 class="text-2xl font-bold text-gray-800">
            MediStock
        </h1>
        <p class="text-gray-500 text-sm mt-2">
            Hospitalario
        </p>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">
            Correo electronico
        </label>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
            class="w-full rounded-lg border border-gray-300 px-4 py-3"
        >
        @error('email')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">
            Contraseña
        </label>
        <input
            type="password"
            name="password"
            required
            class="w-full rounded-lg border border-gray-300 px-4 py-3"
        >
        @error('password')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="mb-5">

        <label class="inline-flex items-center">

            <input
            type="checkbox"
            name="remember"
            class="rounded border-gray-300"
            >

            <span class="ml-2 text-sm text-gray-600">
            Recordarme
            </span>

        </label>

    </div>
    <div class="flex flex-col text-sm mb-6 space-y-2">

        <a href="{{ route('password.request') }}"
           class="text-blue-600 hover:underline">
            ¿Olvidaste tu contraseña?
        </a>

        <a href="#"
           class="text-blue-600 hover:underline">
            Solicitar acceso
        </a>

    </div>

    <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold"
    >
        Iniciar sesión
    </button>

</form>

</x-guest-layout>