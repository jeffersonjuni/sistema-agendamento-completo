@extends('layouts.app')

@section('title', 'Dashboard')


@section('content')


    <div class="space-y-6">


        <x-ui.page-header title="Meu Dashboard" subtitle="Acompanhe seus agendamentos." />



        {{-- KPIs --}}

        <div class="
                grid
                gap-6

                sm:grid-cols-2
                xl:grid-cols-4
            ">


            <x-ui.dashboard-card title="Próximos Agendamentos" :value="$metrics['upcomingAppointments']"
                icon="calendar-clock" variant="primary" />



            <x-ui.dashboard-card title="Total de Agendamentos" :value="$metrics['totalAppointments']" icon="calendar-days"
                variant="success" />



            <x-ui.dashboard-card title="Concluídos" :value="$metrics['completedAppointments']" icon="circle-check"
                variant="warning" />



            <x-ui.dashboard-card title="Último Agendamento" :value="$metrics['lastAppointment']
            ? $metrics['lastAppointment']->appointment_date->format('d/m/Y')
            : 'Nenhum'
                " icon="history"
                variant="primary" />



        </div>




        {{-- Gráficos --}}


        <div class="
                grid
                gap-6

                xl:grid-cols-2
            ">


            <x-ui.dashboard-chart title="Meus Agendamentos por Status" chartId="clientAppointmentsStatusChart" />



            <x-ui.dashboard-chart title="Meus Agendamentos por Mês" chartId="clientAppointmentsMonthChart" />


        </div>





        <div class="
                grid
                gap-6

                xl:grid-cols-2
            ">


            <x-ui.dashboard-chart title="Serviços Mais Utilizados" chartId="clientTopServicesChart" />



        </div>




        {{-- Calendário --}}


        <x-ui.card class="p-6">


            <h2 class="
                    text-lg
                    font-semibold
                    mb-6
                ">

                Meu Calendário

            </h2>



            <div id="calendar" data-events='@json($calendarEvents)' class="
                    min-h-[600px]
                ">

            </div>



        </x-ui.card>



    </div>



@endsection



@push('scripts')


    <script>


        window.dashboardCharts =
            @json($charts);



    </script>


@endpush
