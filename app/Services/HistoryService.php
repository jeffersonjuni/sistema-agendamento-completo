<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use Carbon\Carbon;

class HistoryService
{


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




        /*
        |--------------------------------------------------------------------------
        | Filtro de status
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['status'])
        ) {


            $query->where(
                'status',
                $filters['status']
            );


        }






        /*
        |--------------------------------------------------------------------------
        | Filtro por cliente
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['client'])
        ) {


            $query->whereHas(
                'user',
                function ($user) use ($filters) {


                    $user->where(
                        'name',
                        'like',
                        "%{$filters['client']}%"
                    );


                }
            );


        }








        /*
        |--------------------------------------------------------------------------
        | Filtro por serviço
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['service'])
        ) {


            $query->whereHas(
                'service',
                function ($service) use ($filters) {


                    $service->where(
                        'name',
                        'like',
                        "%{$filters['service']}%"
                    );


                }
            );


        }







        /*
        |--------------------------------------------------------------------------
        | Filtro período
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['start_date'])
        ) {


            $query->whereDate(
                'appointment_date',
                '>=',
                $filters['start_date']
            );


        }



        if (
            !empty($filters['end_date'])
        ) {


            $query->whereDate(
                'appointment_date',
                '<=',
                $filters['end_date']
            );


        }







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
