@extends('layouts.app')

@section('title', 'Relatórios')

@section('content')

    <div class="space-y-6">

        <x-ui.page-header title="Relatórios" subtitle="Visualize indicadores e exporte relatórios do sistema." />

        {{-- Filtros --}}
        <x-ui.card>

            <form method="GET" action="{{ route('admin.reports.index') }}" class="grid md:grid-cols-5 gap-4">

                {{-- Status --}}
                <div>

                    <x-ui.label>
                        Status
                    </x-ui.label>

                    <select name="status" class="input-default">

                        <option value="">
                            Todos
                        </option>

                        <option value="pending" @selected(($filters['status'] ?? '') === 'pending')>
                            Pendente
                        </option>

                        <option value="confirmed" @selected(($filters['status'] ?? '') === 'confirmed')>
                            Confirmado
                        </option>

                        <option value="completed" @selected(($filters['status'] ?? '') === 'completed')>
                            Concluído
                        </option>

                        <option value="cancelled" @selected(($filters['status'] ?? '') === 'cancelled')>
                            Cancelado
                        </option>

                    </select>

                </div>

                {{-- Cliente --}}
                <div>

                    <x-ui.label>
                        Cliente
                    </x-ui.label>

                    <x-ui.input name="client" placeholder="Nome do cliente" :value="$filters['client'] ?? ''" />

                </div>

                {{-- Serviço --}}
                <div>

                    <x-ui.label>
                        Serviço
                    </x-ui.label>

                    <x-ui.input name="service" placeholder="Nome do serviço" :value="$filters['service'] ?? ''" />

                </div>

                {{-- Data Inicial --}}
                <div>

                    <x-ui.label>
                        Data Inicial
                    </x-ui.label>

                    <x-ui.input type="date" name="start_date" :value="$filters['start_date'] ?? ''" />

                </div>

                {{-- Data Final --}}
                <div>

                    <x-ui.label>
                        Data Final
                    </x-ui.label>

                    <x-ui.input type="date" name="end_date" :value="$filters['end_date'] ?? ''" />

                </div>

                {{-- Botões --}}
                <div class="md:col-span-5 flex gap-3">

                    <x-ui.button type="submit">
                        Filtrar
                    </x-ui.button>

                    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">
                        Limpar
                    </a>

                </div>

            </form>

        </x-ui.card>

        {{-- Resumo financeiro --}}
        <div class="grid md:grid-cols-3 gap-4">

            {{-- Receita Total --}}
            <x-ui.card>

                <p class="text-sm text-gray-500">
                    Receita Total
                </p>

                <h2 class="mt-2 text-3xl font-bold text-green-600">

                    R$
                    {{ number_format($summary['revenue'], 2, ',', '.') }}

                </h2>

            </x-ui.card>





            {{-- Serviços Concluídos --}}
            <x-ui.card>

                <p class="text-sm text-gray-500">
                    Serviços Concluídos
                </p>

                <h2 class="mt-2 text-3xl font-bold text-blue-600">

                    {{ $summary['totalServices'] }}

                </h2>

            </x-ui.card>





            {{-- Ticket Médio --}}
            <x-ui.card>

                <p class="text-sm text-gray-500">
                    Ticket Médio
                </p>

                <h2 class="mt-2 text-3xl font-bold text-purple-600">

                    R$
                    {{ number_format($summary['averageTicket'], 2, ',', '.') }}

                </h2>

            </x-ui.card>

        </div>

     {{-- Exportações --}}
<div
    x-data="{
        pdfLoading: false,
        excelLoading: false
    }"
    class="flex flex-wrap gap-3"
>

    {{-- Exportar PDF --}}
    <a
        href="{{ route('admin.reports.pdf', request()->query()) }}"
        class="btn btn-danger"
        @click="pdfLoading = true"
        :class="{ 'opacity-50 pointer-events-none': pdfLoading }"
    >

        <span x-show="!pdfLoading">
            Exportar PDF
        </span>

        <span x-show="pdfLoading">
            Exportando PDF...
        </span>

    </a>





    {{-- Exportar Excel --}}
    <a
        href="{{ route('admin.reports.excel', request()->query()) }}"
        class="btn btn-success"
        @click="excelLoading = true"
        :class="{ 'opacity-50 pointer-events-none': excelLoading }"
    >

        <span x-show="!excelLoading">
            Exportar Excel
        </span>

        <span x-show="excelLoading">
            Exportando Excel...
        </span>

    </a>

</div>

       {{-- Tabela --}}
<x-ui.card>

    <h2 class="text-lg font-semibold mb-6">

        Relatório de Agendamentos

    </h2>

    @if($appointments->isEmpty())

        <x-ui.empty-state
            title="Nenhum registro encontrado"
            description="Não existem agendamentos para os filtros informados."
        />

    @else

        <x-ui.table>

            <thead>

                <tr>

                    <th>
                        Cliente
                    </th>

                    <th>
                        Serviço
                    </th>

                    <th>
                        Data
                    </th>

                    <th>
                        Horário
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Valor
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($appointments as $appointment)

                    <tr>

                        <td>

                            {{ $appointment->user?->name }}

                        </td>

                        <td>

                            {{ $appointment->service?->name }}

                        </td>

                        <td>

                            {{ $appointment->appointment_date->format('d/m/Y') }}

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}

                        </td>

                        <td>

                            @switch($appointment->status->value)

                                @case('pending')

                                    <x-ui.badge variant="warning">
                                        {{ $appointment->status->label() }}
                                    </x-ui.badge>

                                @break

                                @case('confirmed')

                                    <x-ui.badge variant="success">
                                        {{ $appointment->status->label() }}
                                    </x-ui.badge>

                                @break

                                @case('completed')

                                    <x-ui.badge variant="primary">
                                        {{ $appointment->status->label() }}
                                    </x-ui.badge>

                                @break

                                @case('cancelled')

                                    <x-ui.badge variant="danger">
                                        {{ $appointment->status->label() }}
                                    </x-ui.badge>

                                @break

                            @endswitch

                        </td>

                        <td>

                            R$
                            {{ number_format($appointment->service?->price ?? 0, 2, ',', '.') }}

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </x-ui.table>

    @endif

</x-ui.card>

    </div>

@endsection
