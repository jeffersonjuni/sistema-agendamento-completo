<x-layouts.guest>

    <div class="auth-card">

        <x-ui.card>

            <div class="auth-header">

                <h1 class="auth-title">

                    Criar Conta

                </h1>

                <p class="auth-description">

                    Crie sua conta para acessar o sistema e gerenciar clientes, serviços e agendamentos.

                </p>

            </div>

            @if ($errors->any())

                <x-ui.alert variant="danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </x-ui.alert>

            @endif

            <form id="registerForm" method="POST" action="{{ route('register') }}">

                @csrf

                <div class="form-group">

                    <x-ui.label>
                        Nome Completo
                    </x-ui.label>

                    <x-ui.input type="text" name="name" :value="old('name')" placeholder="Digite seu nome" />

                </div>

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

                    <small class="password-hint">
                        Mínimo 8 caracteres, letra maiúscula,
                        número e caractere especial.
                    </small>

                </div>

                <div class="form-group">

                    <x-ui.label>
                        Confirmar senha
                    </x-ui.label>

                    <div class="password-wrapper">

                        <x-ui.input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Confirme sua senha" />

                        <button type="button" class="password-toggle" data-toggle-password="password_confirmation"
                            aria-label="Mostrar senha">
                            <i data-lucide="eye"></i>
                        </button>

                    </div>

                </div>

                <div class="form-footer">

                    <x-ui.button id="registerButton" type="submit">

                        Criar conta

                    </x-ui.button>

                    <a href="{{ route('login') }}" class="form-link">
                        Já possui uma conta? Entrar
                    </a>

                </div>

            </form>

        </x-ui.card>

    </div>

</x-layouts.guest>
