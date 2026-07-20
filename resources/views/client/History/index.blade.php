@extends('layouts.app')

@section('title', 'Histórico')


@section('content')


<div class="space-y-6">


    <x-ui.page-header
        title="Histórico"
        subtitle="Visualize seus próximos atendimentos e agendamentos realizados."
    >


        <a
            href="{{ route('client.appointments.create') }}"
            class="btn btn-primary"
        >

            Novo Agendamento

        </a>


    </x-ui.page-header>





    {{-- Próximos agendamentos --}}

    <x-ui.card>


        <h2 class="text-lg font-semibold mb-6">

            Próximos Agendamentos

        </h2>




        @if($upcomingAppointments->isEmpty())


            <x-ui.empty-state

                title="Nenhum próximo agendamento"

                description="Você não possui atendimentos futuros agendados."

            />



        @else



            <x-ui.table>


                <thead>


                    <tr>


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
                            Duração
                        </th>


                        <th>
                            Status
                        </th>


                    </tr>


                </thead>





                <tbody>



                    @foreach($upcomingAppointments as $appointment)


                        <tr>


                            <td>

                                {{ $appointment->service->name }}

                            </td>




                            <td>

                                {{ $appointment->appointment_date->format('d/m/Y') }}

                            </td>




                            <td>

                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}

                            </td>




                            <td>

                                {{ $appointment->duration }} min

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



                                @endswitch



                            </td>



                        </tr>



                    @endforeach



                </tbody>



            </x-ui.table>



        @endif



    </x-ui.card>









    {{-- Histórico completo --}}


    <x-ui.card>



        <h2 class="text-lg font-semibold mb-6">

            Histórico de Agendamentos

        </h2>





        @if($history->isEmpty())



            <x-ui.empty-state

                title="Nenhum histórico encontrado"

                description="Você ainda não possui agendamentos anteriores."

            />



        @else





            <x-ui.table>



                <thead>


                    <tr>


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
                            Duração
                        </th>


                        <th>
                            Status
                        </th>


                    </tr>


                </thead>




                <tbody>




                    @foreach($history as $appointment)



                        <tr>



                            <td>

                                {{ $appointment->service->name }}

                            </td>




                            <td>

                                {{ $appointment->appointment_date->format('d/m/Y') }}

                            </td>




                            <td>

                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}

                            </td>




                            <td>

                                {{ $appointment->duration }} min

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




                        </tr>



                    @endforeach




                </tbody>




            </x-ui.table>



            <div class="mt-6">


                {{ $history->links() }}


            </div>



        @endif



    </x-ui.card>



</div>


@endsection
