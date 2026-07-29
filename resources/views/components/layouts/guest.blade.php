<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ config('app.name') }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="auth-page">


    <main class="auth-wrapper">


        {{ $slot }}


    </main>





    @if(session('success'))

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                () => {

                    showSuccess(
                        {{ Js::from(session('success')) }}
                    );

                }
            );

        </script>

    @endif





    @if(session('status'))

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                () => {

                    showSuccess(
                        {{ Js::from(session('status')) }}
                    );

                }
            );

        </script>

    @endif





    @if(session('error'))

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                () => {

                    showError(
                        {{ Js::from(session('error')) }}
                    );

                }
            );

        </script>

    @endif





    @if(session('warning'))

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                () => {

                    showWarning(
                        {{ Js::from(session('warning')) }}
                    );

                }
            );

        </script>

    @endif





    @if(session('info'))

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                () => {

                    showInfo(
                        {{ Js::from(session('info')) }}
                    );

                }
            );

        </script>

    @endif





    @if($errors->any())

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                () => {

                    showError(
                        {{ Js::from($errors->first()) }}
                    );

                }
            );

        </script>

    @endif


</body>

</html>
