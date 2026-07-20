<?php

namespace App\Services;

use App\Models\User;
use App\Models\Appointment;
use App\Enums\AppointmentStatus;

class DashboardService
{


    /**
     * Retorna métricas principais do dashboard admin
     */
    public function getAdminMetrics(): array
    {

        return [

            'totalAppointments'
            => Appointment::count(),


            'todayAppointments'
            => Appointment::whereDate(
                    'appointment_date',
                    today()
                )
                    ->count(),


            'totalClients'
            => User::where(
                    'role',
                    'client'
                )
                    ->count(),


            'revenue'
            => $this->getRevenue()

        ];

    }



    /**
     * Calcula faturamento baseado em agendamentos concluídos
     */
    private function getRevenue()
    {

        return Appointment::where(
            'status',
            AppointmentStatus::COMPLETED

        )
            ->with('service')
            ->get()
            ->sum(
                fn($appointment) =>
                $appointment->service?->price ?? 0
            );

    }



    /**
     * Dados utilizados nos gráficos
     */
    public function getAdminCharts(): array
    {

        return [

            'appointmentsStatus'
            => $this->getAppointmentsStatus(),


            'appointmentsByDay'
            => $this->getAppointmentsByDay(),


            'topServices'
            => $this->getTopServices(),


            'completedAppointmentsByMonth'
            => $this->getCompletedAppointmentsByMonth(),


            'revenueByMonth'
            => $this->getRevenueByMonth(),

        ];

    }



    /**
     * Quantidade de agendamentos por status
     */
    private function getAppointmentsStatus()
    {

        return Appointment::selectRaw(
            'status, COUNT(*) as total'
        )
            ->groupBy('status')
            ->pluck(
                'total',
                'status'
            );

    }



    /**
     * Agendamentos agrupados por data
     */
    private function getAppointmentsByDay()
    {

        return Appointment::selectRaw(
            'DATE(appointment_date) as date,
                COUNT(*) as total'
        )
            ->groupBy('date')
            ->orderBy('date')
            ->limit(7)
            ->get()
            ->map(function ($appointment) {


                return [

                    'date'
                    => $appointment->date,


                    'total'
                    => $appointment->total

                ];


            });

    }

    /**
     * Faturamento mensal
     */
    private function getCompletedAppointmentsByMonth()
    {

        return Appointment::query()

            ->where(
                'status',
                AppointmentStatus::COMPLETED
            )

            ->with('service')

            ->selectRaw(
                '
            YEAR(appointment_date) as year,
            MONTH(appointment_date) as month
            '
            )

            ->selectRaw(
                '
            COUNT(*) as totalAppointments
            '
            )

            ->groupBy(
                'year',
                'month'
            )

            ->orderBy(
                'year'
            )

            ->orderBy(
                'month'
            )

            ->get()

            ->map(function ($appointment) {


                return [

                    'month'
                    => sprintf(
                            '%02d/%s',
                            $appointment->month,
                            $appointment->year
                        ),


                    'totalAppointments'
                    => $appointment->totalAppointments

                ];


            });

    }

    /**
     * Faturamento agrupado por mês
     */
    private function getRevenueByMonth()
    {
        return Appointment::query()

            ->join(
                'services',
                'appointments.service_id',
                '=',
                'services.id'
            )

            ->where(
                'appointments.status',
                AppointmentStatus::COMPLETED
            )

            ->selectRaw('
            YEAR(appointments.appointment_date) as year,
            MONTH(appointments.appointment_date) as month,
            SUM(services.price) as total
        ')

            ->groupBy(
                'year',
                'month'
            )

            ->orderBy(
                'year'
            )

            ->orderBy(
                'month'
            )

            ->get()

            ->map(function ($item) {

                return [

                    'month' => sprintf(
                        '%02d/%04d',
                        $item->month,
                        $item->year
                    ),

                    'total' => (float) $item->total,

                ];

            });

    }

    /**
     * Serviços mais utilizados
     */
    private function getTopServices()
    {

        return Appointment::query()

            ->selectRaw(
                '
            service_id,
            COUNT(*) as total
            '
            )

            ->with('service')

            ->groupBy(
                'service_id'
            )

            ->orderByDesc(
                'total'
            )

            ->limit(5)

            ->get()

            ->map(function ($appointment) {


                return [

                    'service'
                    => $appointment->service?->name,


                    'total'
                    => $appointment->total

                ];


            });

    }

    /**
     * Eventos utilizados no calendário
     */
    /**
     * Eventos utilizados no calendário
     */
    public function getCalendarEvents()
    {
        return Appointment::with([
            'user',
            'service'
        ])
            ->orderBy('appointment_date')
            ->get()
            ->map(function ($appointment) {


                $colors = [

                    'pending' => '#f59e0b',

                    'confirmed' => '#22c55e',

                    'completed' => '#3b82f6',

                    'cancelled' => '#ef4444',

                ];


                return [

                    'title' =>
                        $appointment->service->name
                        . ' - '
                        . $appointment->user->name,


                    'start' =>
                        $appointment->appointment_date->format('Y-m-d')
                        . ' '
                        .
                        \Carbon\Carbon::parse(
                            $appointment->appointment_time
                        )->format('H:i:s'),


                    'backgroundColor' =>
                        $colors[$appointment->status->value]
                        ?? '#6366f1',


                    'borderColor' =>
                        $colors[$appointment->status->value]
                        ?? '#6366f1',


                    'extendedProps' => [

                        'status' =>
                            $appointment->status->label(),

                        'service' =>
                            $appointment->service->name,

                        'client' =>
                            $appointment->user->name,

                        'time' =>
                            $appointment->appointment_time,

                    ]

                ];

            });

    }

    public function getClientMetrics(int $userId)
    {

        return [

            'upcomingAppointments' =>
                Appointment::where('user_id', $userId)
                    ->whereDate(
                        'appointment_date',
                        '>=',
                        now()
                    )
                    ->whereNot(
                        'status',
                        'cancelled'
                    )
                    ->count(),



            'totalAppointments' =>
                Appointment::where('user_id', $userId)
                    ->count(),



            'completedAppointments' =>
                Appointment::where('user_id', $userId)
                    ->where(
                        'status',
                        'completed'
                    )
                    ->count(),



            'lastAppointment' =>
                Appointment::where('user_id', $userId)
                    ->latest('appointment_date')
                    ->first(),

        ];

    }

    public function getClientCharts(int $userId)
    {

        return [

            'appointmentsStatus' =>

                Appointment::where(
                    'user_id',
                    $userId
                )
                    ->selectRaw(
                        'status, COUNT(*) as total'
                    )
                    ->groupBy('status')
                    ->pluck(
                        'total',
                        'status'
                    ),



            'appointmentsByMonth' =>

                Appointment::where(
                    'user_id',
                    $userId
                )
                    ->selectRaw(
                        "
                    YEAR(appointment_date) as year,
                    MONTH(appointment_date) as month,
                    COUNT(*) as total
                    "
                    )
                    ->groupBy(
                        'year',
                        'month'
                    )
                    ->orderBy(
                        'year'
                    )
                    ->orderBy(
                        'month'
                    )
                    ->get()
                    ->map(function ($appointment) {


                        return [

                            'year' =>
                                $appointment->year,


                            'month' =>
                                $appointment->month,


                            'total' =>
                                $appointment->total

                        ];


                    }),




            'topServices' =>

                Appointment::where(
                    'user_id',
                    $userId
                )
                    ->selectRaw(
                        "
    service_id,
    COUNT(*) as total
    "
                    )
                    ->groupBy(
                        'service_id'
                    )
                    ->with(
                        'service'
                    )
                    ->orderByDesc(
                        'total'
                    )
                    ->limit(5)
                    ->get()
                    ->map(function ($appointment) {

                        return [

                            'service' =>
                                $appointment->service?->name ?? 'Sem serviço',

                            'total' =>
                                $appointment->total

                        ];

                    }),


        ];

    }

    public function getClientCalendarEvents(int $userId)
    {

        return Appointment::with([
            'service'
        ])
            ->where(
                'user_id',
                $userId
            )
            ->get()
            ->map(function ($appointment) {


                return [

                    'title' =>
                        $appointment->service->name,


                    'start' =>
                        $appointment->appointment_date
                            ->format('Y-m-d')
                        .
                        ' '
                        .
                        \Carbon\Carbon::parse(
                            $appointment->appointment_time
                        )->format('H:i:s'),

                ];


            });

    }

}
