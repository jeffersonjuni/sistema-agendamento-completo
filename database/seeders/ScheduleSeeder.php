<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {

        $schedules = [

            [
                'weekday' => 1,
                'is_open' => true,
                'start_time' => '08:00',
                'end_time' => '18:00',
                'break_start' => '12:00',
                'break_end' => '13:00',
            ],

            [
                'weekday' => 2,
                'is_open' => true,
                'start_time' => '08:00',
                'end_time' => '18:00',
                'break_start' => '12:00',
                'break_end' => '13:00',
            ],

            [
                'weekday' => 3,
                'is_open' => true,
                'start_time' => '08:00',
                'end_time' => '18:00',
                'break_start' => '12:00',
                'break_end' => '13:00',
            ],

            [
                'weekday' => 4,
                'is_open' => true,
                'start_time' => '08:00',
                'end_time' => '18:00',
                'break_start' => '12:00',
                'break_end' => '13:00',
            ],

            [
                'weekday' => 5,
                'is_open' => true,
                'start_time' => '08:00',
                'end_time' => '18:00',
                'break_start' => '12:00',
                'break_end' => '13:00',
            ],

            [
                'weekday' => 6,
                'is_open' => true,
                'start_time' => '08:00',
                'end_time' => '13:00',
                'break_start' => null,
                'break_end' => null,
            ],

            [
                'weekday' => 7,
                'is_open' => false,
                'start_time' => null,
                'end_time' => null,
                'break_start' => null,
                'break_end' => null,
            ],

        ];


        foreach ($schedules as $schedule) {

            Schedule::create($schedule);

        }

    }
}
