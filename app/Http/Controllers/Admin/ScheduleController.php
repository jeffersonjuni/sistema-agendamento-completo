<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Services\ScheduleService;

class ScheduleController extends Controller
{
    public function __construct(
        private ScheduleService $scheduleService
    ) {
    }

    /**
     * Lista todos os horários.
     */
    public function index()
    {
        $schedules = $this->scheduleService->getSchedules();

        return view(
            'admin.schedules.index',
            compact('schedules')
        );
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Schedule $schedule)
    {
        return view(
            'admin.schedules.edit',
            compact('schedule')
        );
    }

    /**
     * Atualiza um horário.
     */
    public function update(
        ScheduleRequest $request,
        Schedule $schedule
    ) {

        $this->scheduleService->updateSchedule(
            $schedule,
            $request->validated()
        );

        return redirect()
            ->route('admin.schedules.index')
            ->with(
                'success',
                'Horário atualizado com sucesso.'
            );
    }
}
