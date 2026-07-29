@extends('layouts.app')

@section('title', 'Meus Agendamentos')


@section('content')

<div class="space-y-6">



    <x-ui.page-header
        title="Meus Agendamentos"
        subtitle="Visualize e gerencie seus horários agendados."
    >

        <a
            href="{{ route('client.appointments.create') }}"
            class="btn btn-primary"
        >

            Novo Agendamento

        </a>


    </x-ui.page-header>







    <x-ui.card>


        <form method="GET" class="grid md:grid-cols-3 gap-4">



            <div>


                <x-ui.label>

                    Status

                </x-ui.label>



                <select
                    name="status"
                    class="input-default"
                >


                    <option value="">

                        Todos

                    </option>




                    <option
                        value="pending"
                        @selected(request('status') === 'pending')
                    >

                        Pendente

                    </option>




                    <option
                        value="confirmed"
                        @selected(request('status') === 'confirmed')
                    >

                        Confirmado

                    </option>




                    <option
                        value="completed"
                        @selected(request('status') === 'completed')
                    >

                        Concluído

                    </option>




                    <option
                        value="cancelled"
                        @selected(request('status') === 'cancelled')
                    >

                        Cancelado

                    </option>



                </select>



            </div>







            <div>


                <x-ui.label>

                    Data

                </x-ui.label>




                <x-ui.input
                    type="date"
                    name="date"
                    :value="request('date')"
                />



            </div>







            <div class="flex items-end gap-3">



                <x-ui.button type="submit">


                    Filtrar


                </x-ui.button>





                <a
                    href="{{ route('client.appointments.index') }}"
                    class="btn btn-secondary"
                >

                    Limpar


                </a>



            </div>





        </form>



    </x-ui.card>









    @if($appointments->isEmpty())



        <x-ui.empty-state
            title="Nenhum agendamento encontrado"
            description="Você ainda não possui nenhum horário agendado."
        />





    @else






        <x-ui.card>



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



                        <th>

                            Ações

                        </th>



                    </tr>



                </thead>








                <tbody>




                    @foreach($appointments as $appointment)



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







                        <td>




                            @if(
                                $appointment->status->value !== 'cancelled'
                                &&
                                $appointment->status->value !== 'completed'
                            )



                                <x-ui.modal title="Cancelar agendamento">





                                    <x-slot name="trigger">



                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                        >

                                            Cancelar

                                        </button>



                                    </x-slot>







                                    <p>


                                        Tem certeza que deseja cancelar o agendamento de


                                        <strong>

                                            {{ $appointment->service->name }}

                                        </strong>



                                        no dia



                                        <strong>

                                            {{ $appointment->appointment_date->format('d/m/Y') }}

                                        </strong>



                                        às



                                        <strong>

                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}

                                        </strong>



                                        ?



                                    </p>








                                    <div class="modal-actions">





                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            @click="open=false"
                                        >

                                            Voltar

                                        </button>







                                        <form
                                            method="POST"
                                            action="{{ route('client.appointments.cancel', $appointment) }}"
                                        >

                                            @csrf

                                            @method('PATCH')





                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >

                                                Confirmar Cancelamento

                                            </button>



                                        </form>





                                    </div>






                                </x-ui.modal>



                            @endif





                        </td>





                    </tr>




                    @endforeach





                </tbody>





            </x-ui.table>




        </x-ui.card>





    @endif





</div>



@endsection
