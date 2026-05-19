@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-default">

        <div class="page-header">
            <h2>Dashboard</h2>
            <p>Bem-vindo ao sistema de agendamento.</p>
        </div>

        <br><br>

        <div class="card-default">

            <h3 style="margin-bottom: 20px;">
                Design System
            </h3>

            <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px;">

                <x-ui.button>
                    Salvar
                </x-ui.button>

                <x-ui.button variant="secondary">
                    Editar
                </x-ui.button>

                <x-ui.button variant="danger">
                    Excluir
                </x-ui.button>

            </div>

            <div style="margin-bottom:20px;">
                <input type="text" class="input-default" placeholder="Digite algo...">
            </div>

            <div style="display:flex; gap:12px; margin-bottom:20px;">

                <x-ui.badge>
                    Ativo
                </x-ui.badge>

                <x-ui.badge variant="warning">
                    Pendente
                </x-ui.badge>

                <x-ui.badge variant="danger">
                    Cancelado
                </x-ui.badge>
            </div>

            <x-ui.table>

                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Jefferson</td>
                        <td>Ativo</td>
                    </tr>

                    <tr>
                        <td>Maria</td>
                        <td>Pendente</td>
                    </tr>

                </tbody>

            </x-ui.table>
            <x-ui.input placeholder="Digite algo..." />

            <x-ui.card>

                <h3 style="margin-bottom:20px;">
                    Card Component
                </h3>

                <p>
                    Conteúdo do card.
                </p>

            </x-ui.card>


            <x-ui.select>

                <option>
                    Selecione
                </option>

                <option>
                    Cliente
                </option>

                <option>
                    Administrador
                </option>

            </x-ui.select>

            <x-ui.alert>
                Operação realizada com sucesso.
            </x-ui.alert>

            <x-ui.alert variant="warning">
                Atenção ao preencher os dados.
            </x-ui.alert>

            <x-ui.alert variant="danger">
                Erro ao processar solicitação.
            </x-ui.alert>


        </div>

        <x-ui.dropdown>

            <x-slot name="trigger">

                <x-ui.button variant="secondary">
                    Menu
                </x-ui.button>

            </x-slot>

            <div style="
            display:flex;
            flex-direction:column;
            gap:8px;
        ">

                <a href="#">
                    Perfil
                </a>

                <a href="#">
                    Configurações
                </a>

                <a href="#">
                    Sair
                </a>

            </div>

        </x-ui.dropdown>



    </div>

    <x-ui.toast>
        Dados salvos com sucesso.
    </x-ui.toast>

@endsection
