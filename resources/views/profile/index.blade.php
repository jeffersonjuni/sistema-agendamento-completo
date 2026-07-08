@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')

    <div class="container-default space-y-6">

        @if(session('success'))

            <x-ui.alert type="success">
                {{ session('success') }}
            </x-ui.alert>

        @endif


        @if($errors->any())

            <x-ui.alert type="error">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </x-ui.alert>

        @endif


        <x-ui.page-header title="Meu Perfil" subtitle="Gerencie suas informações pessoais." />


        <div class="grid gap-6 xl:grid-cols-3">

            {{-- Avatar --}}
            <x-ui.card>

                <div class="flex flex-col items-center">

                    <div
                        class="w-32 h-32 rounded-full overflow-hidden bg-[var(--surface-secondary)] flex items-center justify-center">

                        <img id="avatar-preview" src="{{ $user->avatar
        ? asset('storage/' . $user->avatar)
        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="{{ $user->name }}"
                            class="w-full h-full object-cover">
                    </div>

                    <h2 class="mt-4 text-lg font-semibold">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-[var(--text-secondary)] break-all text-center">
                        {{ $user->email }}
                    </p>

                    <div class="mt-4">

                        <x-ui.badge>

                            {{ ucfirst($user->role) }}

                        </x-ui.badge>

                    </div>

                </div>

            </x-ui.card>

            {{-- Dados pessoais --}}
            <div class="xl:col-span-2">

                <x-ui.card>

                    <h2 class="mb-6 text-lg font-semibold">
                        Dados Pessoais
                    </h2>

                    <form action="{{ auth()->user()->role === 'admin'
        ? route('admin.profile.update')
        : route('client.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">

                        @csrf
                        @method('PATCH')

                        <div>

                            <x-ui.label for="name">
                                Nome
                            </x-ui.label>

                            <x-ui.input id="name" name="name" :value="$user->name" required />

                        </div>

                        <div>

                            <x-ui.label for="email">
                                E-mail
                            </x-ui.label>

                            <x-ui.input id="email" type="email" name="email" :value="$user->email" required />

                        </div>

                        <div>

                            <x-ui.label for="phone">
                                Telefone
                            </x-ui.label>

                            <x-ui.input id="phone" name="phone" :value="$user->phone" placeholder="(11) 99999-9999" />

                        </div>

                        <div>

                            <x-ui.label for="avatar">
                                Foto de Perfil
                            </x-ui.label>

                            <input type="file" id="avatar" name="avatar" accept=".jpg,.jpeg,.png,.webp" class="hidden">

                            <label for="avatar" class="btn btn-secondary cursor-pointer">
                                Escolher arquivo
                            </label>

                            <span id="avatar-file-name" class="text-sm text-[var(--text-secondary)] ml-2">
                                Nenhum arquivo selecionado
                            </span>

                        </div>

                        <x-ui.button type="submit" variant="primary">
                            Salvar Alterações
                        </x-ui.button>

                    </form>

                </x-ui.card>

            </div>

        </div>

        {{-- Senha --}}
        <x-ui.card>

            <h2 class="mb-6 text-lg font-semibold">
                Alterar Senha
            </h2>

            <form action="{{ auth()->user()->role === 'admin'
        ? route('admin.profile.password')
        : route('client.profile.password') }}" method="POST" class="space-y-5">

                @csrf
                @method('PATCH')

                <div>

                    <x-ui.label for="current_password">
                        Senha Atual
                    </x-ui.label>

                    <div class="password-wrapper">

                        <x-ui.input id="current_password" type="password" name="current_password" required />

                        <button type="button" class="password-toggle" data-toggle-password="current_password"
                            aria-label="Mostrar senha">
                            <i data-lucide="eye"></i>
                        </button>

                    </div>

                </div>
                <div>

                    <x-ui.label for="password">
                        Nova Senha
                    </x-ui.label>

                    <div class="
                                text-sm
                                text-[var(--text-secondary)]
                                space-y-1
                            ">

                        <p>
                            A senha deve conter:
                        </p>

                        <ul class="list-disc ml-5">

                            <li>
                                Mínimo de 8 caracteres
                            </li>

                            <li>
                                Uma letra maiúscula
                            </li>

                            <li>
                                Uma letra minúscula
                            </li>

                            <li>
                                Um número
                            </li>

                            <li>
                                Um caractere especial
                            </li>

                        </ul>

                    </div>

                    <div class="password-wrapper">

                        <x-ui.input id="password" type="password" name="password" required />

                        <button type="button" class="password-toggle" data-toggle-password="password"
                            aria-label="Mostrar senha">
                            <i data-lucide="eye"></i>
                        </button>

                    </div>

                </div>

                <div>

                    <x-ui.label for="password_confirmation">
                        Confirmar Nova Senha
                    </x-ui.label>

                    <div class="password-wrapper">

                        <x-ui.input id="password_confirmation" type="password" name="password_confirmation" required />

                        <button type="button" class="password-toggle" data-toggle-password="password_confirmation"
                            aria-label="Mostrar senha">
                            <i data-lucide="eye"></i>
                        </button>

                    </div>

                </div>

                <x-ui.button type="submit" variant="primary">
                    Atualizar Senha
                </x-ui.button>

            </form>

        </x-ui.card>

    </div>

@endsection

@push('scripts')

    <script>

        const avatarInput =
            document.getElementById('avatar');

        const avatarPreview =
            document.getElementById('avatar-preview');

        const fileName =
            document.getElementById('avatar-file-name');

        avatarInput?.addEventListener(
            'change',
            function () {

                const file = this.files[0];

                if (!file) {
                    return;
                }

                fileName.textContent = file.name;

                const reader = new FileReader();

                reader.onload = function (e) {

                    avatarPreview.src =
                        e.target.result;

                };

                reader.readAsDataURL(file);

            }
        );

        const phoneInput =
            document.getElementById('phone');

        phoneInput?.addEventListener(
            'input',
            function (e) {

                let value =
                    e.target.value
                        .replace(/\D/g, '')
                        .slice(0, 11);

                if (value.length > 10) {

                    value =
                        value.replace(
                            /^(\d{2})(\d{5})(\d{0,4}).*/,
                            '($1) $2-$3'
                        );

                } else {

                    value =
                        value.replace(
                            /^(\d{2})(\d{4})(\d{0,4}).*/,
                            '($1) $2-$3'
                        );

                }

                e.target.value = value;

            }
        );

        initializePasswordToggles();

    </script>

@endpush
