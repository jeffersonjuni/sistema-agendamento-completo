@extends('layouts.app')

@section('title', 'Histórico')


@section('content')


<div class="space-y-6">


    <x-ui.page-header

        title="Histórico"

        subtitle="Visualize todos os agendamentos realizados no sistema."

    />

    <x-ui.card>


    <form method="GET" class="grid md:grid-cols-5 gap-4">


        {{-- Status --}}
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





        {{-- Cliente --}}
        <div>


            <x-ui.label>
                Cliente
            </x-ui.label>


            <x-ui.input

                name="client"

                placeholder="Nome do cliente"

                :value="request('client')"

            />


        </div>





        {{-- Serviço --}}
        <div>


            <x-ui.label>
                Serviço
            </x-ui.label>


            <x-ui.input

                name="service"

                placeholder="Nome do serviço"

                :value="request('service')"

            />


        </div>






        {{-- Data inicial --}}
        <div>


            <x-ui.label>
                Data Inicial
            </x-ui.label>


            <x-ui.input

                type="date"

                name="start_date"

                :value="request('start_date')"

            />


        </div>





        {{-- Data final --}}
        <div>


            <x-ui.label>
                Data Final
            </x-ui.label>


            <x-ui.input

                type="date"

                name="end_date"

                :value="request('end_date')"

            />


        </div>





        {{-- Botões --}}
        <div class="md:col-span-5 flex gap-3">


            <x-ui.button type="submit">

                Filtrar

            </x-ui.button>




            <a

                href="{{ route('admin.history.index') }}"

                class="btn btn-secondary"

            >

                Limpar

            </a>


        </div>



    </form>


</x-ui.card>





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





        <x-ui.table class="datatable">



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
