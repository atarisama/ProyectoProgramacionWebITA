<x-guest-layout>

    <div
        class="
            bg-white
            rounded-2xl
            shadow-2xl
            p-8
            w-full
            max-w-md
            border
            border-gray-100
        "
    >

        {{-- Encabezado --}}
        <div class="text-center mb-6">

            <div class="text-5xl mb-3">
                
            </div>

            <h1 class="text-2xl font-bold text-gray-800">
                Recuperar contraseña
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Ingresa tu correo electrónico y te enviaremos un enlace para
                restablecer tu contraseña.
            </p>

        </div>

        {{-- Mensaje de éxito --}}
        <x-auth-session-status
            class="mb-4"
            :status="session('status')"
        />

        <form
            method="POST"
            action="{{ route('password.email') }}"
        >
            @csrf

            {{-- Correo electrónico --}}
            <div class="mb-5">

                <x-input-label
                    for="email"
                    value="Correo electrónico"
                />

                <div class="relative mt-2">

                    <span
                        class="
                            absolute
                            left-3
                            top-1/2
                            -translate-y-1/2
                            text-gray-400
                        "
                    >
                        
                    </span>

                    <x-text-input
                        id="email"
                        class="block w-full pl-10"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                    />

                </div>

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />

            </div>

            {{-- Botón --}}
            <div class="mt-6">

                <x-primary-button
                    class="
                        w-full
                        justify-center
                        py-3
                        rounded-xl
                    "
                >
                    Enviar enlace de recuperación
                </x-primary-button>

            </div>

        </form>

        {{-- Regresar al login --}}
        <div class="text-center mt-6">

            <a
                href="{{ route('login') }}"
                class="
                    text-sm
                    text-blue-600
                    hover:text-blue-800
                    hover:underline
                "
            >
                ← Volver al inicio de sesión
            </a>

        </div>

    </div>

</x-guest-layout>