<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Agendamento')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('components.sidebar')

    <div>

        @include('components.navbar')

        <main>
            @yield('content')
        </main>

        @include('components.footer')

    </div>

</body>
</html>
