<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Filters\AppointmentFilter;
use App\Models\Appointment;

class ReportService
{

    public function __construct(
        private AppointmentFilter $appointmentFilter
    ) {
    }

    /**
     * Retorna os agendamentos utilizados
     * nos relatórios e exportações.
     */
    public function getAppointmentsReport(
        array $filters = []
    )
    {

        $query = Appointment::with([

            'user',

            'service',

        ]);


        $this->appointmentFilter
            ->apply(
                $query,
                $filters
            );


        return $query

            ->orderByDesc(
                'appointment_date'
            )

            ->orderByDesc(
                'appointment_time'
            )

            ->get();

    }

    /**
     * Retorna o resumo financeiro
     * utilizado nos cards do relatório.
     */
    public function getRevenueSummary(
        array $filters = []
    ): array
    {

        $query = Appointment::with('service')

            ->where(
                'status',
                AppointmentStatus::COMPLETED
            );


        $this->appointmentFilter
            ->apply(
                $query,
                $filters
            );


        $appointments = $query->get();


        $revenue = $appointments->sum(

            fn ($appointment) =>

            $appointment->service?->price ?? 0

        );


        $totalServices = $appointments->count();


        $averageTicket =

            $totalServices > 0

                ? $revenue / $totalServices

                : 0;


        return [

            'revenue' => $revenue,

            'totalServices' => $totalServices,

            'averageTicket' => round(
                $averageTicket,
                2
            ),

        ];

    }

}
