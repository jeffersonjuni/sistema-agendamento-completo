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

    @if(session('success'))

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                showSuccess(
                    {{ Js::from(session('success')) }}
                );

            });
        </script>

    @endif


    @if(session('error'))

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                showError(
                    {{ Js::from(session('error')) }}
                );

            });
        </script>

    @endif


    @if(session('warning'))

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                showWarning(
                    {{ Js::from(session('warning')) }}
                );

            });
        </script>

    @endif


    @if(session('info'))

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                showInfo(
                    {{ Js::from(session('info')) }}
                );

            });
        </script>

    @endif
    @stack('scripts')

    @if($errors->any())

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                showError(
                    {{ Js::from($errors->first()) }}
                );

            });
        </script>

    @endif

</body>

</html>
