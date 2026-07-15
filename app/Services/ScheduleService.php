<?php

namespace App\Services;

use App\Models\Schedule;

class ScheduleService
{
    /**
     * Retorna todos os horários cadastrados.
     */
    public function getSchedules()
    {
        return Schedule::orderBy('weekday')->get();
    }



    /**
     * Retorna um horário específico.
     */
    public function getScheduleById(int $id)
    {
        return Schedule::findOrFail($id);
    }



    /**
     * Atualiza um horário.
     */
    public function updateSchedule(
        Schedule $schedule,
        array $data
    ) {

        if (!$data['is_open']) {

            $data['start_time'] = null;
            $data['end_time'] = null;
            $data['break_start'] = null;
            $data['break_end'] = null;

        }


        $schedule->update($data);


        return $schedule;

    }



    /**
     * Retorna o horário de um dia da semana.
     */
    public function getScheduleByWeekday(
        int $weekday
    ) {

        return Schedule::where(
            'weekday',
            $weekday
        )->firstOrFail();

    }



    /**
     * Verifica se o dia está aberto.
     */
    public function isOpen(
        int $weekday
    ) {

        return $this
            ->getScheduleByWeekday($weekday)
            ->is_open;

    }
}
