@extends('layouts.app')

@section('title', 'Horários')


@section('content')

    <div class="space-y-6">


        <x-ui.page-header title="Horários de Expediente" subtitle="Configure os dias e horários de funcionamento." />



        <x-ui.card>


            <div class="overflow-x-auto">


                <x-ui.table>


                    <thead>

                        <tr>

                            <th>
                                Dia
                            </th>


                            <th>
                                Status
                            </th>


                            <th>
                                Expediente
                            </th>


                            <th>
                                Intervalo
                            </th>


                            <th>
                                Ações
                            </th>


                        </tr>


                    </thead>



                    <tbody>


                        @foreach($schedules as $schedule)


                                            <tr>


                                                <td class="font-medium">


                                                    {{ match ($schedule->weekday) {

                                1 => 'Segunda-feira',
                                2 => 'Terça-feira',
                                3 => 'Quarta-feira',
                                4 => 'Quinta-feira',
                                5 => 'Sexta-feira',
                                6 => 'Sábado',
                                7 => 'Domingo',

                            } }}


                                                </td>




                                                <td>


                                                    @if($schedule->is_open)


                                                        <x-ui.badge variant="success">

                                                            Aberto

                                                        </x-ui.badge>


                                                    @else


                                                        <x-ui.badge variant="danger">

                                                            Fechado

                                                        </x-ui.badge>


                                                    @endif


                                                </td>




                                                <td>


                                                    @if($schedule->is_open)


                                                        <span class="font-medium">

                                                            {{ Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                                                        </span>


                                                        até


                                                        <span class="font-medium">

                                                            {{ Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                                                        </span>


                                                    @else

                                                        —

                                                    @endif


                                                </td>




                                                <td>


                                                    @if($schedule->break_start && $schedule->break_end)


                                                        {{ Carbon\Carbon::parse($schedule->break_start)->format('H:i') }}

                                                        -

                                                        {{ Carbon\Carbon::parse($schedule->break_end)->format('H:i') }}


                                                    @else

                                                        —

                                                    @endif


                                                </td>




                                                <td>


                                                    <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-primary"
                                                        title="Editar horário">

                                                        Editar

                                                    </a>


                                                </td>



                                            </tr>


                        @endforeach


                    </tbody>


                </x-ui.table>


            </div>


        </x-ui.card>


    </div>


@endsection
