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

            <button class="btn btn-primary">
                Salvar
            </button>

            <button class="btn btn-secondary">
                Editar
            </button>

            <button class="btn btn-danger">
                Excluir
            </button>

        </div>

        <div style="margin-bottom:20px;">
            <input
                type="text"
                class="input-default"
                placeholder="Digite algo..."
            >
        </div>

        <div style="display:flex; gap:12px; margin-bottom:20px;">

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

        <table class="table-default">

            <thead>
                <tr>
                    <th>Cliente</th>
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

        </table>

    </div>

</div>

@endsection
