<?php

namespace App\Http\Controllers\Client;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Services\AppointmentService;

class AppointmentController extends Controller
{
    public function __construct(
        private AppointmentService $appointmentService
    ) {
    }

    /**
     * Meus agendamentos
     */
    public function index()
    {
        $appointments = $this->appointmentService
            ->getUserAppointments(auth()->id());

        return view(
            'client.appointments.index',
            compact('appointments')
        );
    }

    /**
     * Formulário de novo agendamento
     */
    public function create()
    {
        return view('client.appointments.create');
    }

    /**
     * Salvar agendamento
     */
    public function store(StoreAppointmentRequest $request)
    {
        $this->appointmentService->createAppointment(
            $request->validated(),
            auth()->id()
        );

        return redirect()
            ->route('client.appointments.index')
            ->with(
                'success',
                'Agendamento realizado com sucesso.'
            );
    }

    /**
     * Cancelar próprio agendamento
     */
    public function cancel(
        Appointment $appointment
    ) {

        if (
            $appointment->user_id !== auth()->id()
        ) {

            abort(403);

        }



        $this->appointmentService
            ->cancelAppointment(
                $appointment
            );



        return redirect()

            ->route(
                'client.appointments.index'
            )

            ->with(
                'success',
                'Agendamento cancelado com sucesso.'
            );

    }
}
