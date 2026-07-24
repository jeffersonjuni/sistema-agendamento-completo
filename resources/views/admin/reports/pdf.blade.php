<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Relatório</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background: #f2f2f2;
        }

        h1 {
            margin-bottom: 5px;
        }
    </style>

</head>

<body>

    <h1>Relatório de Agendamentos</h1>

    <p>
        Faturamento:
        R$ {{ number_format($summary['revenue'], 2, ',', '.') }}
    </p>

    <p>
        Total de serviços:
        {{ $summary['totalServices'] }}
    </p>

    <p>
        Ticket médio:
        R$ {{ number_format($summary['averageTicket'], 2, ',', '.') }}
    </p>

    <table>

        <thead>

            <tr>

                <th>Cliente</th>

                <th>Serviço</th>

                <th>Data</th>

                <th>Status</th>

                <th>Valor</th>

            </tr>

        </thead>

        <tbody>

            @foreach($appointments as $appointment)

                <tr>

                    <td>{{ $appointment->user->name }}</td>

                    <td>{{ $appointment->service->name }}</td>

                    <td>{{ $appointment->appointment_date->format('d/m/Y') }}</td>

                    <td>{{ $appointment->status->label() }}</td>

                    <td>
                        R$
                        {{ number_format($appointment->service->price, 2, ',', '.') }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>

</html>
