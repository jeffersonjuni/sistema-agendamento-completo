<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Http\Requests\UpdateAppointmentStatusRequest;

class AppointmentController extends Controller
{

    public function __construct(
        private AppointmentService $appointmentService
    ) {
    }


    /**
     * Listagem completa (Admin)
     */
    public function index()
    {
        $appointments =
            $this->appointmentService
                ->getAppointments();


        return view(
            'admin.appointments.index',
            compact('appointments')
        );
    }



    /**
     * Atualizar status do agendamento
     */
    public function updateStatus(
        UpdateAppointmentStatusRequest $request,
        Appointment $appointment
    ) {





        $this->appointmentService
            ->updateStatus(
                $appointment,
                $request->status
            );



        return redirect()

            ->route(
                'admin.appointments.index'
            )

            ->with(
                'success',
                'Status atualizado com sucesso.'
            );

    }





    /**
     * Cancelar agendamento
     */
    public function cancel(
        Appointment $appointment
    ) {

        $this->appointmentService
            ->cancelAppointment(
                $appointment
            );



        return redirect()

            ->route(
                'admin.appointments.index'
            )

            ->with(
                'success',
                'Agendamento cancelado com sucesso.'
            );

    }

}
