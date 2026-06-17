<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistema de Agendamento')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="layout">

        @include('components.layouts.sidebar')

        <div class="mobile-overlay" id="mobileOverlay"></div>

        <div class="main-content">

            @include('components.layouts.navbar')

            <main class="content">
                @yield('content')
            </main>

            @include('components.layouts.footer')

        </div>

    </div>

    @stack('scripts')

</body>

</html>
