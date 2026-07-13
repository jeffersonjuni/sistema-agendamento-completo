<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class ScheduleValidator
{
    /**
     * Horário de início do expediente.
     */
    private const BUSINESS_START = '08:00';


    /**
     * Horário de encerramento do expediente.
     */
    private const BUSINESS_END = '18:00';


    /**
     * Início do intervalo.
     */
    private const BREAK_START = '12:00';


    /**
     * Fim do intervalo.
     */
    private const BREAK_END = '13:00';



    /**
     * Executa todas as validações da agenda.
     */
    public function validate(
        array $data,
        Service $service
    ): void {

        /**
         * 1 - Verifica datas passadas
         */
        $this->validatePastDate($data);


        /**
         * 2 - Verifica expediente
         */
        $this->validateBusinessHours(
            $data,
            $service
        );


        /**
         * 3 - Verifica intervalo
         */
        $this->validateBreakTime(
            $data,
            $service
        );


        /**
         * 4 - Verifica conflitos
         */
        $this->validateConflict(
            $data,
            $service
        );


        /**
         * 5 - Verifica horário duplicado
         */
        $this->validateDuplicate($data);

    }



    /**
     * Impede agendamentos em datas ou horários passados.
     */
    private function validatePastDate(array $data): void
    {
        $appointmentDateTime = Carbon::parse(
            $data['appointment_date']
            . ' '
            .
            $data['appointment_time']
        );


        if ($appointmentDateTime->isPast()) {

            throw ValidationException::withMessages([
                'appointment_date' =>
                    'Não é permitido realizar agendamentos em datas ou horários passados.',
            ]);

        }
    }



    /**
     * Valida expediente considerando duração.
     */
    private function validateBusinessHours(
        array $data,
        Service $service
    ): void {

        $start = Carbon::parse(
            $data['appointment_date']
            . ' '
            .
            $data['appointment_time']
        );


        $end = $start->copy()
            ->addMinutes(
                $service->duration
            );


        $businessStart = Carbon::parse(
            $data['appointment_date']
            . ' '
            .
            self::BUSINESS_START
        );


        $businessEnd = Carbon::parse(
            $data['appointment_date']
            . ' '
            .
            self::BUSINESS_END
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
     * Valida intervalo considerando duração completa.
     */
    private function validateBreakTime(
        array $data,
        Service $service
    ): void {


        $start = Carbon::parse(
            $data['appointment_date']
            . ' '
            .
            $data['appointment_time']
        );


        $end = $start->copy()
            ->addMinutes(
                $service->duration
            );


        $breakStart = Carbon::parse(
            $data['appointment_date']
            . ' '
            .
            self::BREAK_START
        );


        $breakEnd = Carbon::parse(
            $data['appointment_date']
            . ' '
            .
            self::BREAK_END
        );


        if (
            $start->lt($breakEnd)
            &&
            $end->gt($breakStart)
        ) {

            throw ValidationException::withMessages([
                'appointment_time' =>
                    'Não é possível realizar agendamentos durante o intervalo de almoço.',
            ]);

        }

    }




    /**
     * Impede conflitos de agenda considerando duração.
     */
    private function validateConflict(
        array $data,
        Service $service
    ): void {

        $newStart = Carbon::parse(
            $data['appointment_date']
            . ' '
            .
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
                    'pending',
                    'confirmed'
                ]
            )
            ->get();



        foreach ($appointments as $appointment) {


            $existingStart = Carbon::parse(
                $appointment->appointment_date->format('Y-m-d')
                . ' '
                . $appointment->appointment_time
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
     * Impede dois agendamentos exatamente no mesmo horário.
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
                    'pending',
                    'confirmed'
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
