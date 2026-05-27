<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediStock Hospitalario</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f4f3fa] min-h-screen flex items-center justify-center">

    <div class="w-full max-w-4xl px-4">

        {{-- Logo --}}
        <div class="flex justify-center mb-10">

            <img
                src="{{ asset('images/MediStock.png') }}"
                alt="MediStock"
                class="h-20 object-contain"
            >

        </div>

        {{-- Tarjetas --}}
        <div class="flex flex-col md:flex-row justify-center gap-6">

            {{-- Director --}}
            <a
                href="{{ route('login') }}"
                class="
                    bg-white
                    rounded-lg
                    shadow-md
                    border
                    border-gray-200
                    w-72
                    transition
                    duration-300
                    hover:shadow-xl
                    hover:-translate-y-1
                "
            >

                <div class="p-6 text-center">

                    <img
                        src="{{ asset('images/Medico.png') }}"
                        alt="Director"
                        class="w-24 h-24 mx-auto object-contain mb-4"
                    >

                    <h2 class="text-3xl font-medium text-gray-700 leading-tight">

                        Director
                        <br>
                        del hospital

                    </h2>

                </div>

                <div
                    class="
                        bg-gray-100
                        border-t
                        p-4
                        flex
                        items-center
                        justify-center
                        gap-3
                    "
                >

                    <img
                        src="{{ asset('images/director_barra.png') }}"
                        alt=""
                        class="w-8 h-8"
                    >

                    <span class="text-gray-700 font-medium">

                        Director
                        del hospital

                    </span>

                </div>

            </a>

            {{-- Médico / Enfermería --}}
            <a
                href="{{ route('login') }}"
                class="
                    bg-white
                    rounded-lg
                    shadow-md
                    border
                    border-gray-200
                    w-72
                    transition
                    duration-300
                    hover:shadow-xl
                    hover:-translate-y-1
                "
            >

                <div class="p-6 text-center">

                    <img
                        src="{{ asset('images/Enfermeria.png') }}"
                        alt="Médico"
                        class="w-24 h-24 mx-auto object-contain mb-4"
                    >

                    <h2 class="text-3xl font-medium text-gray-700 leading-tight">

                        Médico/
                        <br>
                        enfermería

                    </h2>

                </div>

                <div
                    class="
                        bg-gray-100
                        border-t
                        p-4
                        flex
                        items-center
                        justify-center
                        gap-3
                    "
                >

                    <img
                        src="{{ asset('images/Enfermeria.png') }}"
                        alt=""
                        class="w-8 h-8"
                    >

                    <span class="text-gray-700 font-medium">

                        Médico/
                        enfermería

                    </span>

                </div>

            </a>

        </div>

    </div>

</body>
</html>