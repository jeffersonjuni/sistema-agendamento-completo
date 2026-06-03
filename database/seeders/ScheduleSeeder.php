<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Schedule::create([
        'weekday' => 1,
        'start_time' => '08:00',
        'end_time' => '18:00',
        'break_start' => '12:00',
        'break_end' => '13:00',
    ]);
}
}
