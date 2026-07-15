<?php

namespace App\Http\Controllers\Client;

use App\Models\Appointment;
use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Services\AppointmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;

class AppointmentController extends Controller
{
    public function __construct(
        private AppointmentService $appointmentService
    ) {
    }

    public function schedules()
{
    return response()->json(

        Schedule::select(
            'weekday',
            'is_open',
            'start_time',
            'end_time',
            'break_start',
            'break_end'
        )
        ->orderBy('weekday')
        ->get()

    );
}


    public function availableTimes(Request $request)
    {
        $times = $this->appointmentService->getAvailableTimes(
            $request->date,
            $request->service
        );

        return response()->json($times);
    }

    /**
     * Meus agendamentos
     */
    /**
     * Meus agendamentos
     */
    public function index(Request $request)
    {
        $query = Appointment::with('service')
            ->where('user_id', auth()->id());

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }

        if ($request->filled('date')) {

            $query->whereDate(
                'appointment_date',
                $request->date
            );

        }

        $appointments = $query
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->get();

        return view(
            'client.appointments.index',
            compact('appointments')
        );
    }

    /**
     * Formulário de novo agendamento
     */
    /**
     * Formulário de novo agendamento
     */
    public function create()
    {
        $services = Service::where(
            'status',
            true
        )
            ->orderBy('name')
            ->get();

        $schedules = Schedule::orderBy(
            'weekday'
        )->get();

        $minDate = Carbon::today()
            ->format('Y-m-d');

        return view(
            'client.appointments.create',
            compact(
                'services',
                'schedules',
                'minDate'
            )
        );
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
