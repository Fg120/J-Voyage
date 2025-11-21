<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tittle')</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative w-full h-screen bg-cover bg-center flex flex-col justify-center items-center gap-10 p-0 m-0 font-sans"
    style="background-image: url('{{ asset('assets/images/bg-pantai.png') }}');" >
    <div class="absolute bg-black/40 inset-0 -z-10"></div>
    <div class="text-white flex justify-center items-center gap-3">
        <img class="w-16 h-auto" src="{{ Vite::asset('public/assets/images/logo.png') }}" alt="Logo">
        <h1 class="font-sans font-bold text-5xl">J-Voyage</h1>
    </div>

    @yield('form')
</body>

</html>
