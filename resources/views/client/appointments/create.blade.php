@extends('layouts.app')

@section('title', 'Novo Agendamento')

@section('content')

    <div class="space-y-6">

        <x-ui.page-header title="Novo Agendamento" subtitle="Escolha o serviço, data e horário desejado.">

            <a href="{{ route('client.appointments.index') }}" class="btn btn-secondary">
                Voltar
            </a>

        </x-ui.page-header>

        @if(session('success'))

            <x-ui.alert type="success">

                {{ session('success') }}

            </x-ui.alert>

        @endif

        @if($errors->any())

            <x-ui.alert type="error">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </x-ui.alert>

        @endif

        <form method="POST" action="{{ route('client.appointments.store') }}" class="space-y-6">

            @csrf

            {{-- Dados do agendamento --}}
            <x-ui.card>

                {{-- Serviço --}}
                <div>

                    <x-ui.label>
                        Escolha o serviço
                    </x-ui.label>

                    <div class="grid md:grid-cols-2 gap-4 mt-3">

                        @foreach($services as $service)

                            <x-ui.service-card :service="$service" :selected="old('service_id') == $service->id" />

                        @endforeach

                    </div>

                </div>

                {{-- Data e horário --}}
                <div class="space-y-5 mt-6">

                    <div>

                        <x-ui.label>
                            Escolha a data
                        </x-ui.label>

                        <div id="calendar" class="
                                    mt-3
                                    border
                                    rounded-xl
                                    p-5
                                    w-full
                                "></div>

                        <input type="hidden" name="appointment_date" id="appointment_date"
                            value="{{ old('appointment_date') }}" required>

                    </div>

                    <div>

                        <x-ui.label>
                            Escolha o horário
                        </x-ui.label>

                        <div id="time-slots" class="
                                    grid
                                    grid-cols-3
                                    md:grid-cols-6
                                    gap-3
                                    mt-3
                                ">

                            <p class="text-sm text-[var(--text-secondary)]">

                                Selecione uma data primeiro.

                            </p>

                        </div>

                        <input type="hidden" name="appointment_time" id="appointment_time"
                            value="{{ old('appointment_time') }}" required>

                    </div>

                </div>

            </x-ui.card>

            {{-- Resumo --}}
            <x-ui.card>

                <h2 class="text-lg font-semibold mb-5">

                    Resumo do Agendamento

                </h2>

                <div class="space-y-4">

                    <div>

                        <x-ui.label>
                            Serviço
                        </x-ui.label>

                        <p id="summary-service" class="text-[var(--text-secondary)]">

                            Nenhum serviço selecionado.

                        </p>

                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>

                            <x-ui.label>
                                Data
                            </x-ui.label>

                            <p id="summary-date" class="text-[var(--text-secondary)]">

                                Nenhuma data selecionada.

                            </p>

                        </div>

                        <div>

                            <x-ui.label>
                                Horário
                            </x-ui.label>

                            <p id="summary-time" class="text-[var(--text-secondary)]">

                                Nenhum horário selecionado.

                            </p>

                        </div>

                    </div>

                    <div>

                        <x-ui.label>
                            Duração
                        </x-ui.label>

                        <p id="summary-duration" class="text-[var(--text-secondary)]">

                            -

                        </p>

                    </div>

                </div>

            </x-ui.card>

            <div class="flex justify-end gap-3">

                <a href="{{ route('client.appointments.index') }}" class="btn btn-secondary">

                    Cancelar

                </a>

                <x-ui.button type="submit">

                    Confirmar Agendamento

                </x-ui.button>

            </div>

        </form>

    </div>

@endsection
