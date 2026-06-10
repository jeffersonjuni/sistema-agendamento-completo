<x-layouts.guest>

    <div class="auth-card">

        <x-ui.card>

            <div class="auth-header">

                <h1 class="auth-title">

                    Esqueceu sua senha?

                </h1>

                <p class="auth-description">

                    Informe seu endereço de email para receber um link de redefinição de senha.

                </p>

            </div>

            @if(session('status'))

                <x-ui.alert>

                    {{ session('status') }}

                </x-ui.alert>

            @endif

            @if ($errors->any())

                <x-ui.alert variant="danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>

                                {{ $error }}

                            </li>

                        @endforeach

                    </ul>

                </x-ui.alert>

            @endif

            <form method="POST" action="{{ route('password.email') }}">

                @csrf

                <div class="form-group">

                    <x-ui.label>

                        Email

                    </x-ui.label>

                    <x-ui.input type="email" name="email" :value="old('email')" placeholder="Digite seu email" />

                </div>

                <div class="form-footer">

                    <x-ui.button id="forgotButton" type="submit">

                        Enviar link

                    </x-ui.button>

                    <a href="{{ route('login') }}" class="form-link">

                        Voltar para login

                    </a>

                </div>

            </form>

        </x-ui.card>

    </div>

</x-layouts.guest>
