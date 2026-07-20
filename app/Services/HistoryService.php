<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Filters\AppointmentFilter;
use Carbon\Carbon;

class HistoryService
{

    public function __construct(
        private AppointmentFilter $appointmentFilter
    ) {

    }

    /**
     * Retorna próximos agendamentos do cliente.
     */
    public function getClientUpcomingAppointments(
        int $userId
    ) {


        return Appointment::with('service')


            ->where(
                'user_id',
                $userId
            )


            ->whereIn(
                'status',
                [
                    AppointmentStatus::PENDING->value,

                    AppointmentStatus::CONFIRMED->value,
                ]
            )


            ->where(function ($query) {


                $query->where(
                    'appointment_date',
                    '>',
                    Carbon::today()
                )


                    ->orWhere(function ($query) {


                        $query->whereDate(
                            'appointment_date',
                            Carbon::today()
                        )


                            ->whereTime(
                                'appointment_time',
                                '>=',
                                Carbon::now()->format('H:i:s')
                            );


                    });


            })


            ->orderBy(
                'appointment_date'
            )


            ->orderBy(
                'appointment_time'
            )


            ->get();


    }









    /**
     * Retorna histórico de agendamentos do cliente.
     */
    public function getClientHistory(
        int $userId
    ) {


        return Appointment::with('service')


            ->where(
                'user_id',
                $userId
            )


            ->where(function ($query) {


                $query->whereIn(
                    'status',
                    [
                        AppointmentStatus::COMPLETED->value,

                        AppointmentStatus::CANCELLED->value,
                    ]
                )


                    ->orWhere(
                        'appointment_date',
                        '<',
                        Carbon::today()
                    );


            })


            ->orderByDesc(
                'appointment_date'
            )


            ->orderByDesc(
                'appointment_time'
            )


            ->paginate(10);


    }









    /**
     * Retorna histórico geral de agendamentos (Admin).
     */
    public function getAdminHistory(
        array $filters = []
    ) {

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

            ->paginate(15);

    }
}
