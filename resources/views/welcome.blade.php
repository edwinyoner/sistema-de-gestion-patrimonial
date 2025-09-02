<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Gestión de Activos - Municipalidad Distrital de Jangas</title>
   
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Fuente Figtree desde Bunny -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- CSS propio -->
    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
</head>

<body>

    <main>
        <div class="container">
            <!-- Encabezado -->
            <header>
                <h1>SISTEMA DE GESTIÓN PATRIMONIAL</h1>
                <h2>WINNER SYSTEMS CORPORATION SAC</h2>
            </header>

            <!-- Logo -->
            <img src="{{ asset('assets/images/Logo.jpg') }}" alt="Logo WINNER SYSTEMS CORPORATION SAC"
                class="logo">

            <!-- Botones -->
            <div class="button-group">
                @auth
                    <a href="{{ url('/dashboard') }}">Ir al Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrar</a>
                    @endif
                @endauth
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} WINNER SYSTEMS CORPORATION SAC. Todos los derechos reservados.</p>
    </footer>

</body>

</html>
