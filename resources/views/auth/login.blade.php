<x-layouts.guest>

    <div class="auth-card">

        <x-ui.card>

            <div class="auth-header">

                <h1 class="auth-title">

                    Sistema de Agendamento

                </h1>

                <p class="auth-description">

                    Gerencie clientes, serviços e horários de forma simples e organizada.

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

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </x-ui.alert>

            @endif

            <form id="loginForm" method="POST" action="{{ route('login') }}">

                @csrf

                <div class="form-group">

                    <x-ui.label>

                        Email

                    </x-ui.label>

                    <x-ui.input type="email" name="email" :value="old('email')" placeholder="Digite seu email" />

                </div>

                <div class="form-group">

                    <x-ui.label>

                        Senha

                    </x-ui.label>

                    <div class="password-wrapper">

                        <x-ui.input id="password" type="password" name="password" placeholder="Digite sua senha" />

                        <button type="button" class="password-toggle" data-toggle-password="password"
                            aria-label="Mostrar senha">
                            <i data-lucide="eye"></i>
                        </button>

                    </div>

                </div>

                <div class="form-footer">

                    <x-ui.button id="loginButton" type="submit">

                        Entrar

                    </x-ui.button>

                    <a href="{{ route('password.request') }}" class="form-link">

                        Esqueceu sua senha?

                    </a>

                    <a href="{{ route('register') }}" class="form-link">

                        Criar uma conta

                    </a>

                </div>

            </form>

        </x-ui.card>

    </div>

</x-layouts.guest>
