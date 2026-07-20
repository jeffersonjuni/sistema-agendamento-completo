import Chart from "chart.js/auto";

const charts = window.dashboardCharts;

const statusLabels = {
    pending: "Pendente",

    confirmed: "Confirmado",

    completed: "Concluído",

    cancelled: "Cancelado",
};

if (charts) {
    /*
    |--------------------------------------------------------------------------
    | Agendamentos por Status
    |--------------------------------------------------------------------------
    */

    const statusCanvas =
        document.getElementById("appointmentsStatusChart") ||
        document.getElementById("clientAppointmentsStatusChart");

    if (statusCanvas && charts.appointmentsStatus) {
        new Chart(statusCanvas, {
            type: "doughnut",

            data: {
                labels: Object.keys(charts.appointmentsStatus).map(
                    (status) => statusLabels[status] ?? status,
                ),

                datasets: [
                    {
                        data: Object.values(charts.appointmentsStatus),
                    },
                ],
            },

            options: {
                responsive: true,

                plugins: {
                    legend: {
                        position: "bottom",
                    },
                },
            },
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Agendamentos por Dia / Mês
    |--------------------------------------------------------------------------
    */

    const appointmentsCanvas =
        document.getElementById("appointmentsByDayChart") ||
        document.getElementById("clientAppointmentsMonthChart");

    if (
        appointmentsCanvas &&
        (charts.appointmentsByDay || charts.appointmentsByMonth)
    ) {
        const dataSource =
            charts.appointmentsByDay ?? charts.appointmentsByMonth;

        new Chart(appointmentsCanvas, {
            type: "line",

            data: {
                labels: dataSource.map((item) => {
                    if (item.date) {
                        return new Date(item.date).toLocaleDateString("pt-BR");
                    }

                    return `${item.month}/${item.year}`;
                }),

                datasets: [
                    {
                        label: "Agendamentos",

                        data: dataSource.map((item) => item.total),

                        tension: 0.4,
                    },
                ],
            },

            options: {
                responsive: true,

                plugins: {
                    legend: {
                        position: "bottom",
                    },
                },
            },
        });
    }

    /*
|--------------------------------------------------------------------------
| Serviços mais utilizados
|--------------------------------------------------------------------------
*/

    const servicesCanvas =
        document.getElementById("topServicesChart") ||
        document.getElementById("clientTopServicesChart");

    if (servicesCanvas && charts.topServices) {
        new Chart(servicesCanvas, {
            type: "bar",

            data: {
                labels: charts.topServices.map(
                    (item) => item.service ?? "Sem nome",
                ),

                datasets: [
                    {
                        label: "Quantidade de Agendamentos",

                        data: charts.topServices.map((item) =>
                            Number(item.total),
                        ),
                    },
                ],
            },

            options: {
                responsive: true,

                plugins: {
                    legend: {
                        position: "bottom",
                    },
                },

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                        },
                    },
                },
            },
        });
    }
    /*
    |--------------------------------------------------------------------------
    | Receita Mensal (somente Admin)
    |--------------------------------------------------------------------------
    */

    const revenueCanvas = document.getElementById("revenueChart");

    if (revenueCanvas && charts.revenueByMonth) {
        new Chart(revenueCanvas, {
            type: "bar",

            data: {
                labels: charts.revenueByMonth.map((item) => item.month),

                datasets: [
                    {
                        label: "Faturamento (R$)",

                        data: charts.revenueByMonth.map((item) => item.total),
                    },
                ],
            },

            options: {
                responsive: true,

                plugins: {
                    legend: {
                        position: "bottom",
                    },
                },

                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }
}
