@extends('layouts.app')

@section('title', 'Serviços')

@section('content')

    <div class="space-y-6">


        <x-ui.page-header title="Serviços" subtitle="Gerencie os serviços oferecidos.">

            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                Novo Serviço
            </a>

        </x-ui.page-header>





        @if($services->isEmpty())


            <x-ui.empty-state title="Nenhum serviço cadastrado"
                description="Cadastre o primeiro serviço para começar os agendamentos." />



        @else



            <x-ui.card>


                <x-ui.table>


                    <thead>

                        <tr>

                            <th>
                                Nome
                            </th>


                            <th>
                                Preço
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


                        @foreach($services as $service)


                            <tr>


                                <td>
                                    {{ $service->name }}
                                </td>





                                <td>
                                    R$ {{ number_format($service->price, 2, ',', '.') }}
                                </td>





                                <td>
                                    {{ $service->duration }} min
                                </td>





                                <td>

                                    <form method="POST" action="{{ route('admin.services.toggle-status', $service) }}">

                                        @csrf
                                        @method('PATCH')


                                        <button type="submit">

                                            @if($service->status)

                                                <x-ui.badge variant="success">
                                                    Ativo
                                                </x-ui.badge>

                                            @else

                                                <x-ui.badge variant="danger">
                                                    Inativo
                                                </x-ui.badge>

                                            @endif

                                        </button>


                                    </form>

                                </td>






                                <td>


                                    <div class="flex gap-2">



                                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary">
                                            Editar
                                        </a>







                                        <x-ui.modal title="Excluir serviço">


                                            <x-slot name="trigger">

                                                <button type="button" class="btn btn-danger">
                                                    Excluir
                                                </button>

                                            </x-slot>



                                            <p>
                                                Tem certeza que deseja excluir o serviço
                                                <strong>{{ $service->name }}</strong>?
                                            </p>



                                            <div class="modal-actions">


                                                <button type="button" class="btn btn-secondary" @click="open=false">
                                                    Cancelar
                                                </button>



                                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}">

                                                    @csrf
                                                    @method('DELETE')


                                                    <button type="submit" class="btn btn-danger">
                                                        Confirmar exclusão
                                                    </button>


                                                </form>


                                            </div>


                                        </x-ui.modal>

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
