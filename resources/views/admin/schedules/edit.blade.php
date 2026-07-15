@extends('layouts.app')

@section('title', 'Editar Horário')


@section('content')


                    @php

$weekdays = [
    1 => 'Segunda-feira',
    2 => 'Terça-feira',
    3 => 'Quarta-feira',
    4 => 'Quinta-feira',
    5 => 'Sexta-feira',
    6 => 'Sábado',
    7 => 'Domingo',
];

@endphp

    <div class="space-y-6">


        <x-ui.page-header title="Editar Horário" subtitle="Atualize o expediente do dia selecionado." />


        @if($errors->any())

            <x-ui.alert type="danger">

                <ul class="list-disc pl-5 space-y-1">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </x-ui.alert>

        @endif



        <x-ui.card>


            <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}" class="space-y-6"
                id="schedule-form">

                @csrf
                @method('PUT')



                <div>

                    <x-ui.label>
                        Dia da Semana
                    </x-ui.label>




                    <x-ui.input
    :value="$weekdays[$schedule->weekday]"
    disabled
/>

                </div>





                <div>


                    <x-ui.label>
                        Funcionamento
                    </x-ui.label>


                    <select name="is_open" id="is_open" class="input-default">

                        <option value="1" @selected(old('is_open', $schedule->is_open) == 1)>
                            Aberto
                        </option>


                        <option value="0" @selected(old('is_open', $schedule->is_open) == 0)>
                            Fechado
                        </option>


                    </select>


                </div>





                <div id="schedule-fields" class="space-y-6">


                    <div class="grid md:grid-cols-2 gap-4">


                        <div>

                            <x-ui.label>
                                Horário de abertura
                            </x-ui.label>


                            <x-ui.input type="time" name="start_time" id="start_time"
                                :value="old('start_time', $schedule->start_time)" />


                        </div>



                        <div>

                            <x-ui.label>
                                Horário de fechamento
                            </x-ui.label>


                            <x-ui.input type="time" name="end_time" id="end_time"
                                :value="old('end_time', $schedule->end_time)" />

                        </div>


                    </div>





                    <div class="grid md:grid-cols-2 gap-4">


                        <div>

                            <x-ui.label>
                                Início do intervalo
                            </x-ui.label>


                            <x-ui.input type="time" name="break_start" id="break_start"
                                :value="old('break_start', $schedule->break_start)" />


                        </div>




                        <div>

                            <x-ui.label>
                                Fim do intervalo
                            </x-ui.label>


                            <x-ui.input type="time" name="break_end" id="break_end"
                                :value="old('break_end', $schedule->break_end)" />


                        </div>


                    </div>


                </div>





                <div class="flex gap-3">


                    <x-ui.button type="submit" id="save-button">

                        <span id="save-text">
                            Salvar Alterações
                        </span>


                        <span id="save-loading" class="hidden">
                            Salvando...
                        </span>


                    </x-ui.button>




                    <a href="{{route('admin.schedules.index')}}" class="btn btn-secondary">
                        Cancelar
                    </a>


                </div>



            </form>


        </x-ui.card>


    </div>

@endsection




@push('scripts')

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            () => {


                const status =
                    document.getElementById('is_open');


                const fields =
                    document.querySelectorAll(
                        '#schedule-fields input'
                    );



                function toggleFields() {


                    const enabled =
                        status.value === '1';



                    fields.forEach(field => {


                        field.disabled =
                            !enabled;


                        field.classList.toggle(
                            'opacity-50',
                            !enabled
                        );



                    });



                }



                toggleFields();



                status.addEventListener(
                    'change',
                    () => {


                        if (status.value === '0') {


                            const confirmClose =
                                confirm(
                                    'Deseja realmente deixar este dia fechado?'
                                );


                            if (!confirmClose) {

                                status.value = '1';

                                return;

                            }


                        }


                        toggleFields();


                    });






                const form =
                    document.getElementById(
                        'schedule-form'
                    );


                const button =
                    document.getElementById(
                        'save-button'
                    );


                const text =
                    document.getElementById(
                        'save-text'
                    );


                const loading =
                    document.getElementById(
                        'save-loading'
                    );



                form.addEventListener(
                    'submit',
                    () => {


                        button.disabled = true;


                        text.classList.add(
                            'hidden'
                        );


                        loading.classList.remove(
                            'hidden'
                        );


                    });



            });

    </script>

@endpush
