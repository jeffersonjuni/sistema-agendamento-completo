@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="space-y-6">

        <x-ui.page-header title="Dashboard" subtitle="Bem-vindo ao painel administrativo." />

        {{-- KPIs --}}
        <div class="
                        grid
                        gap-6

                        sm:grid-cols-2
                        xl:grid-cols-4
                    ">

            <x-ui.dashboard-card title="Total de Agendamentos" :value="$metrics['totalAppointments']" icon="calendar-days"
                variant="primary" />

            <x-ui.dashboard-card title="Agendamentos Hoje" :value="$metrics['todayAppointments']" icon="calendar-check"
                variant="success" />

            <x-ui.dashboard-card title="Clientes" :value="$metrics['totalClients']" icon="users" variant="warning" />

            <x-ui.dashboard-card title="Faturamento" :value="'R$ ' . number_format($metrics['revenue'], 2, ',', '.')"
                icon="wallet" variant="success" />

        </div>

        {{-- Primeira linha --}}
        <div class="
                        grid
                        gap-6

                        xl:grid-cols-2
                    ">

            <x-ui.dashboard-chart title="Agendamentos por Status" chartId="appointmentsStatusChart" />

            <x-ui.dashboard-chart title="Agendamentos por Dia" chartId="appointmentsByDayChart" />

        </div>

        {{-- Segunda linha --}}
        <div class="
                        grid
                        gap-6

                        xl:grid-cols-2
                    ">

            <x-ui.dashboard-chart title="Serviços Mais Utilizados" chartId="topServicesChart" />

            <x-ui.dashboard-chart title="Receita Mensal" chartId="revenueChart" />

        </div>

        {{-- Calendário --}}
        <x-ui.card class="p-6">

            <h2 class="
                            text-lg
                            font-semibold
                            mb-6
                        ">
                Calendário
            </h2>

            <div id="calendar" data-events='@json($calendarEvents)' class="
            min-h-[600px]
        ">
            </div>


            <script>

                window.dashboardEvents =
                    @json($calendarEvents);

            </script>

        </x-ui.card>

    </div>

@endsection

@push('scripts')

    <script>

        window.dashboardCharts = @json($charts);

    </script>

@endpush
