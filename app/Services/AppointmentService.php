<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Service;

class AppointmentService
{
    public function __construct(
        private ScheduleValidator $scheduleValidator
    ) {
    }



    /**
     * Retorna todos os agendamentos (Admin)
     */
    public function getAppointments()
    {
        return Appointment::with([
            'user',
            'service',
        ])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();
    }



    /**
     * Retorna os agendamentos do usuário autenticado (Cliente)
     */
    public function getUserAppointments(int $userId)
    {
        return Appointment::with([
            'service',
        ])
            ->where(
                'user_id',
                $userId
            )
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();
    }



    /**
     * Cria um novo agendamento.
     */
    public function createAppointment(
        array $data,
        int $userId
    ) {

        $service = Service::findOrFail(
            $data['service_id']
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




    /**
     * Cancela um agendamento.
     */
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




    /**
     * Atualiza o status do agendamento.
     */
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

            'status' =>
                $status,

        ]);



        return $appointment;

    }
}
