@extends('layouts.app')

@section('title', 'Agendamentos')


@section('content')

    <div class="space-y-6">


        <x-ui.page-header title="Agendamentos" subtitle="Gerencie todos os agendamentos realizados." />

        <x-ui.card>


            <form method="GET" class="grid md:grid-cols-4 gap-4">


                <div>

                    <x-ui.label>
                        Status
                    </x-ui.label>


                    <select name="status" class="input-default">

                        <option value="">
                            Todos
                        </option>


                        <option value="pending" @selected(request('status') === 'pending')>
                            Pendente
                        </option>


                        <option value="confirmed" @selected(request('status') === 'confirmed')>
                            Confirmado
                        </option>


                        <option value="completed" @selected(request('status') === 'completed')>
                            Concluído
                        </option>


                        <option value="cancelled" @selected(request('status') === 'cancelled')>
                            Cancelado
                        </option>


                    </select>


                </div>





                <div>


                    <x-ui.label>
                        Data
                    </x-ui.label>


                    <x-ui.input type="date" name="date" :value="request('date')" />


                </div>





                <div>


                    <x-ui.label>
                        Cliente ou Serviço
                    </x-ui.label>


                    <x-ui.input name="search" placeholder="Digite..." :value="request('search')" />


                </div>






                <div class="flex items-end gap-3">


                    <x-ui.button type="submit">

                        Filtrar

                    </x-ui.button>



                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">

                        Limpar

                    </a>


                </div>




            </form>


        </x-ui.card>




        @if(session('success'))

            <x-ui.alert type="success">

                {{ session('success') }}

            </x-ui.alert>

        @endif




        @if($appointments->isEmpty())


    <x-ui.empty-state
        title="Nenhum agendamento encontrado"
        description="Não existem agendamentos para os filtros selecionados."
    />


@else



            <x-ui.card>



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
                                Ações
                            </th>


                        </tr>


                    </thead>





                    <tbody>



                        @foreach($appointments as $appointment)



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

            <x-ui.badge>
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



                                    <div class="flex gap-2">


                                        {{-- Confirmar --}}

                                        @if($appointment->status->value === 'pending')


<form method="POST"
    action="{{ route('admin.appointments.update-status', $appointment) }}">

    @csrf
    @method('PATCH')

    <input
        type="hidden"
        name="status"
        value="confirmed"
    >

    <button class="btn btn-primary">

        Confirmar

    </button>

</form>



@elseif($appointment->status->value === 'confirmed')


<form method="POST"
    action="{{ route('admin.appointments.update-status', $appointment) }}">

    @csrf
    @method('PATCH')

    <input
        type="hidden"
        name="status"
        value="completed"
    >

    <button class="btn btn-secondary">

        Concluir

    </button>

</form>


@endif




                                        {{-- Cancelar --}}


                                        @if($appointment->status->value !== 'cancelled')


                                            <form
    method="POST"
    action="{{ route('admin.appointments.cancel', $appointment) }}"
    onsubmit="return confirm('Deseja realmente cancelar este agendamento?')"
>
                                                @csrf
                                                @method('PATCH')


                                                <button class="btn btn-danger" type="submit">

                                                    Cancelar

                                                </button>


                                            </form>


                                        @endif



                                    </div>



                                </td>






                            </tr>



                        @endforeach




                    </tbody>



                </x-ui.table>




            </x-ui.card>



        @endif




    </div>


@endsection
