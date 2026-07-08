@extends('layouts.app')

@section('title', 'Editar Serviço')


@section('content')


    <div class="space-y-6">



        <x-ui.page-header title="Editar Serviço" subtitle="Atualize as informações do serviço.">

            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                Voltar
            </a>


        </x-ui.page-header>





        @if(session('success'))

            <x-ui.alert type="success">
                {{ session('success') }}
            </x-ui.alert>

        @endif


        @if($errors->any())

            <x-ui.alert type="error">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </x-ui.alert>

        @endif







        <x-ui.card>



            <form method="POST" action="{{ route('admin.services.update', $service) }}" class="space-y-5">


                @csrf

                @method('PUT')





                <div>


                    <x-ui.label>
                        Nome do Serviço
                    </x-ui.label>



                    <x-ui.input name="name" :value="old('name', $service->name)" required />


                </div>







                <div>


                    <x-ui.label>
                        Descrição
                    </x-ui.label>



                    <textarea name="description" class="input-default"
                        rows="4">{{ old('description', $service->description) }}</textarea>



                </div>









                <div class="grid md:grid-cols-2 gap-5">



                    <div>


                        <x-ui.label>
                            Preço
                        </x-ui.label>



                        <x-ui.input type="number" step="0.01" name="price" :value="old('price', $service->price)"
                            required />


                    </div>







                    <div>


                        <x-ui.label>
                            Duração (minutos)
                        </x-ui.label>



                        <x-ui.input type="number" name="duration" :value="old('duration', $service->duration)" required />


                    </div>



                </div>









                <div>


                    <x-ui.label>
                        Status
                    </x-ui.label>





                    <select name="status" class="input-default">



                        <option value="1" @selected(old('status', $service->status) == 1)>
                            Ativo
                        </option>




                        <option value="0" @selected(old('status', $service->status) == 0)>
                            Inativo
                        </option>




                    </select>



                </div>









                <div class="flex justify-end gap-3">



                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>




                    <x-ui.button type="submit">
                        Atualizar Serviço
                    </x-ui.button>



                </div>





            </form>



        </x-ui.card>




    </div>



@endsection
