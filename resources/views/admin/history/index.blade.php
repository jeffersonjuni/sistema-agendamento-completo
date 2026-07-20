@extends('layouts.app')

@section('title', 'Histórico')


@section('content')


<div class="space-y-6">


    <x-ui.page-header

        title="Histórico"

        subtitle="Visualize todos os agendamentos realizados no sistema."

    />





    <x-ui.card>


        <h2 class="text-lg font-semibold mb-6">

            Histórico de Agendamentos

        </h2>





        @if($history->isEmpty())


            <x-ui.empty-state

                title="Nenhum histórico encontrado"

                description="Ainda não existem agendamentos registrados."

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

                                {{ $appointment->user->name }}

                            </td>





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
