<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\Enums\AppointmentStatus;

class ScheduleValidator
{
    /**
     * Obtém o expediente do dia da semana.
     */
    private function getSchedule(string $date): Schedule
    {
        $weekday = Carbon::parse($date)->isoWeekday();

        return Schedule::where(
            'weekday',
            $weekday
        )->firstOrFail();
    }


    /**
     * Normaliza horário vindo do banco.
     *
     * Aceita:
     * 08:00
     * 08:00:00
     * 2026-07-15 08:00:00
     */
    private function buildDateTime(
        string $date,
        string $time
    ): Carbon {

        $formattedTime = Carbon::parse($time)
            ->format('H:i:s');


        return Carbon::parse(
            "{$date} {$formattedTime}"
        );
    }


    /**
     * Executa todas validações.
     */
    public function validate(
        array $data,
        Service $service
    ): void {


        $this->validatePastDate($data);


        $schedule = $this->getSchedule(
            $data['appointment_date']
        );


        $this->validateBusinessHours(
            $data,
            $service,
            $schedule
        );


        $this->validateBreakTime(
            $data,
            $service,
            $schedule
        );


        $this->validateConflict(
            $data,
            $service
        );


        $this->validateDuplicate($data);

    }



    /**
     * Impede datas passadas.
     */
    private function validatePastDate(array $data): void
    {

        $dateTime = $this->buildDateTime(
            $data['appointment_date'],
            $data['appointment_time']
        );


        if ($dateTime->isPast()) {

            throw ValidationException::withMessages([
                'appointment_date' =>
                    'Não é permitido realizar agendamentos em datas ou horários passados.',
            ]);

        }

    }



    /**
     * Valida horário comercial.
     */
    private function validateBusinessHours(
        array $data,
        Service $service,
        Schedule $schedule
    ): void {


        if (!$schedule->is_open) {

            throw ValidationException::withMessages([
                'appointment_date' =>
                    'Este dia não possui expediente.',
            ]);

        }


        $start = $this->buildDateTime(
            $data['appointment_date'],
            $data['appointment_time']
        );


        $end = $start->copy()
            ->addMinutes(
                $service->duration
            );


        $businessStart = $this->buildDateTime(
            $data['appointment_date'],
            $schedule->start_time
        );


        $businessEnd = $this->buildDateTime(
            $data['appointment_date'],
            $schedule->end_time
        );


        if (
            $start->lt($businessStart)
            ||
            $end->gt($businessEnd)
        ) {

            throw ValidationException::withMessages([
                'appointment_time' =>
                    'O horário informado está fora do expediente.',
            ]);

        }

    }



    /**
     * Valida intervalo.
     */
    private function validateBreakTime(
        array $data,
        Service $service,
        Schedule $schedule
    ): void {


        if (
            !$schedule->break_start
            ||
            !$schedule->break_end
        ) {
            return;
        }



        $start = $this->buildDateTime(
            $data['appointment_date'],
            $data['appointment_time']
        );


        $end = $start->copy()
            ->addMinutes(
                $service->duration
            );


        $breakStart = $this->buildDateTime(
            $data['appointment_date'],
            $schedule->break_start
        );


        $breakEnd = $this->buildDateTime(
            $data['appointment_date'],
            $schedule->break_end
        );



        if (
            $start->lt($breakEnd)
            &&
            $end->gt($breakStart)
        ) {

            throw ValidationException::withMessages([
                'appointment_time' =>
                    'Não é possível realizar agendamentos durante o intervalo.',
            ]);

        }

    }



    /**
     * Valida conflito de horários.
     */
    private function validateConflict(
        array $data,
        Service $service
    ): void {


        $newStart = $this->buildDateTime(
            $data['appointment_date'],
            $data['appointment_time']
        );


        $newEnd = $newStart->copy()
            ->addMinutes(
                $service->duration
            );



        $appointments = Appointment::where(
            'appointment_date',
            $data['appointment_date']
        )
            ->whereIn(
                'status',
                [
                    AppointmentStatus::PENDING->value,
                    AppointmentStatus::CONFIRMED->value
                ]
            )
            ->get();



        foreach ($appointments as $appointment) {


            $existingStart = $this->buildDateTime(
                $appointment->appointment_date->format('Y-m-d'),
                $appointment->appointment_time
            );


            $existingEnd = $existingStart->copy()
                ->addMinutes(
                    $appointment->duration
                );



            if (
                $newStart->lt($existingEnd)
                &&
                $newEnd->gt($existingStart)
            ) {


                throw ValidationException::withMessages([
                    'appointment_time' =>
                        'O horário informado entra em conflito com outro agendamento.',
                ]);

            }

        }

    }



    /**
     * Bloqueia horário duplicado.
     */
    private function validateDuplicate(array $data): void
    {


        $exists = Appointment::where(
            'appointment_date',
            $data['appointment_date']
        )
            ->where(
                'appointment_time',
                $data['appointment_time']
            )
            ->whereIn(
                'status',
                [
                    AppointmentStatus::PENDING->value,
                    AppointmentStatus::CONFIRMED->value,
                ]
            )
            ->exists();



        if ($exists) {


            throw ValidationException::withMessages([
                'appointment_time' =>
                    'Este horário já está ocupado.',
            ]);

        }

    }
}
