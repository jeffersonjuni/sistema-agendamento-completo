@extends('layouts.app')

@section('title', 'Componentes')

@section('content')
<div class="container-default">

    <div class="page-header mb-8">
        <h2>Biblioteca de Componentes</h2>
        <p>Componentes reutilizáveis do sistema administrativo.</p>
    </div>

    {{-- BUTTONS --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Buttons</h3>

        <div class="flex gap-4 flex-wrap">
            <button class="btn btn-primary">
                Primary
            </button>

            <button class="btn btn-secondary">
                Secondary
            </button>

            <button class="btn btn-danger">
                Danger
            </button>

            <button class="btn btn-primary" disabled>
                Disabled
            </button>

            <button class="btn btn-primary">
                <span class="loader-sm"></span>
                Loading
            </button>
        </div>
    </div>

    {{-- INPUTS --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Inputs</h3>

        <div class="grid-2">
            <input
                type="text"
                class="input-default"
                placeholder="Digite seu nome"
            >

            <select class="input-default">
                <option>Selecione uma opção</option>
                <option>Administrador</option>
                <option>Cliente</option>
            </select>

            <textarea
                class="input-default"
                rows="5"
                placeholder="Digite uma descrição"
            ></textarea>
        </div>
    </div>

    {{-- BADGES --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Badges</h3>

        <div class="flex gap-4 flex-wrap">
            <span class="badge badge-success">
                Ativo
            </span>

            <span class="badge badge-warning">
                Pendente
            </span>

            <span class="badge badge-danger">
                Cancelado
            </span>
        </div>
    </div>

    {{-- ALERTS --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Alerts</h3>

        <div class="alert alert-success mb-4">
            Operação realizada com sucesso.
        </div>

        <div class="alert alert-warning mb-4">
            Atenção aos dados informados.
        </div>

        <div class="alert alert-danger">
            Ocorreu um erro ao processar.
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Table</h3>

        <div class="table-responsive">
            <table class="table-default">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Status</th>
                        <th>Perfil</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Jefferson</td>
                        <td>
                            <span class="badge badge-success">
                                Ativo
                            </span>
                        </td>
                        <td>Administrador</td>
                    </tr>

                    <tr>
                        <td>Maria</td>
                        <td>
                            <span class="badge badge-warning">
                                Pendente
                            </span>
                        </td>
                        <td>Cliente</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- EMPTY STATE --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Empty State</h3>

        <div class="empty-state">
            <h4>Nenhum registro encontrado</h4>

            <p>
                Não existem dados cadastrados até o momento.
            </p>

            <button class="btn btn-primary">
                Criar Registro
            </button>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Pagination</h3>

        <div class="pagination">
            <button class="pagination-item active">1</button>
            <button class="pagination-item">2</button>
            <button class="pagination-item">3</button>
            <button class="pagination-item">4</button>
        </div>
    </div>

    {{-- DROPDOWN --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Dropdown</h3>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle">
                Menu
            </button>

            <div class="dropdown-menu">
                <a href="#">Perfil</a>
                <a href="#">Configurações</a>
                <a href="#">Sair</a>
            </div>
        </div>
    </div>

    {{-- TOAST --}}
    <div class="card-default mb-6">
        <h3 class="mb-4">Toast</h3>

        <div class="toast toast-success">
            Registro salvo com sucesso.
        </div>
    </div>

    {{-- LOADER --}}
    <div class="card-default">
        <h3 class="mb-4">Loader</h3>

        <div class="flex items-center gap-4">
            <div class="loader"></div>

            <span>Carregando dados...</span>
        </div>
    </div>

</div>
@endsection
