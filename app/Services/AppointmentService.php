<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Schedule;
use Carbon\Carbon;

class AppointmentService
{
    public function __construct(
        private ScheduleValidator $scheduleValidator
    ) {
    }


    /**
     * Normaliza horário recebido.
     *
     * Aceita:
     * 08:00
     * 08:00:00
     * 2026-07-15 08:00:00
     */
    private function normalizeTime(string $time): string
    {
        if (str_contains($time, ' ')) {

            return Carbon::parse($time)
                ->format('H:i');

        }

        return Carbon::parse($time)
            ->format('H:i');

    }



    /**
     * Retorna todos os agendamentos (Admin)
     */
    public function getAppointments(array $filters = [])
    {
        $query = Appointment::with([
            'user',
            'service',
        ]);


        if (!empty($filters['status'])) {

            $query->where(
                'status',
                $filters['status']
            );

        }


        if (!empty($filters['date'])) {

            $query->whereDate(
                'appointment_date',
                $filters['date']
            );

        }


        if (!empty($filters['search'])) {

            $search = $filters['search'];

            $query->where(function ($q) use ($search) {

                $q->whereHas(
                    'user',
                    function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    }
                )
                    ->orWhereHas(
                        'service',
                        function ($service) use ($search) {

                            $service->where(
                                'name',
                                'like',
                                "%{$search}%"
                            );

                        }
                    );

            });

        }


        return $query
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

    }





    /**
     * Retorna agendamentos do cliente.
     */
    public function getUserAppointments(int $userId)
    {
        return Appointment::with('service')
            ->where(
                'user_id',
                $userId
            )
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

    }





    /**
     * Busca horários disponíveis.
     */
    public function getAvailableTimes(
        string $date,
        int $serviceId
    ): array {


        $service = Service::findOrFail(
            $serviceId
        );


        $weekday = Carbon::parse($date)
            ->isoWeekday();



        $schedule = Schedule::where(
            'weekday',
            $weekday
        )->first();



        if (
            !$schedule
            ||
            !$schedule->is_open
        ) {

            return [];

        }



        $start = Carbon::parse(
            $date . ' ' .
            Carbon::parse($schedule->start_time)
                ->format('H:i')
        );



        $end = Carbon::parse(
            $date . ' ' .
            Carbon::parse($schedule->end_time)
                ->format('H:i')
        );



        $breakStart = $schedule->break_start
            ? Carbon::parse(
                $date . ' ' .
                Carbon::parse($schedule->break_start)
                    ->format('H:i')
            )
            : null;



        $breakEnd = $schedule->break_end
            ? Carbon::parse(
                $date . ' ' .
                Carbon::parse($schedule->break_end)
                    ->format('H:i')
            )
            : null;




        $appointments = Appointment::where(
            'appointment_date',
            $date
        )
            ->whereIn(
                'status',
                [
                    'pending',
                    'confirmed'
                ]
            )
            ->get();



        $available = [];



        while (
            $start->copy()
                ->addMinutes($service->duration)
                ->lte($end)
        ) {

            $current = $start->copy();


            $currentEnd = $current
                ->copy()
                ->addMinutes(
                    $service->duration
                );



            if (
                $breakStart
                &&
                $breakEnd
                &&
                $current->lt($breakEnd)
                &&
                $currentEnd->gt($breakStart)
            ) {

                $start->addMinutes(30);

                continue;

            }



            $conflict = $appointments->contains(
                function ($appointment) use ($current, $currentEnd) {

                    $existingStart = Carbon::parse(
                        $appointment
                            ->appointment_date
                            ->format('Y-m-d')
                        . ' ' .
                        $appointment->appointment_time
                    );


                    $existingEnd = $existingStart
                        ->copy()
                        ->addMinutes(
                            $appointment->duration
                        );


                    return
                        $current->lt($existingEnd)
                        &&
                        $currentEnd->gt($existingStart);

                }
            );



            if (!$conflict) {

                $available[] =
                    $current->format('H:i');

            }



            $start->addMinutes(30);

        }


        return $available;

    }





    /**
     * Cria agendamento.
     */
    public function createAppointment(
        array $data,
        int $userId
    ) {

        $service = Service::findOrFail(
            $data['service_id']
        );



        /**
         * Normalização preventiva
         */
        $data['appointment_date'] =
            Carbon::parse(
                $data['appointment_date']
            )
                ->format('Y-m-d');



        $data['appointment_time'] =
            $this->normalizeTime(
                $data['appointment_time']
            );



        $data['duration'] =
            $service->duration;




        $this->scheduleValidator->validate(
            $data,
            $service
        );




        return Appointment::create([

            'user_id' =>
                $userId,


            'service_id' =>
                $service->id,


            'appointment_date' =>
                $data['appointment_date'],


            'appointment_time' =>
                $data['appointment_time'],


            'duration' =>
                $service->duration,


            'status' =>
                AppointmentStatus::PENDING->value,

        ]);

    }






    public function cancelAppointment(
        Appointment $appointment
    ) {

        if (
            $appointment->status === AppointmentStatus::CANCELLED
        ) {

            throw new \Exception(
                'Este agendamento já está cancelado.'
            );

        }



        $appointment->update([

            'status' =>
                AppointmentStatus::CANCELLED->value,

        ]);



        return $appointment;

    }






    public function updateStatus(
        Appointment $appointment,
        string $status
    ) {

        $allowedStatus = [

            AppointmentStatus::PENDING->value,

            AppointmentStatus::CONFIRMED->value,

            AppointmentStatus::COMPLETED->value,

            AppointmentStatus::CANCELLED->value,

        ];



        if (
            !in_array(
                $status,
                $allowedStatus
            )
        ) {

            throw new \Exception(
                'Status de agendamento inválido.'
            );

        }



        $appointment->update([

            'status' => $status,

        ]);



        return $appointment;

    }

}
