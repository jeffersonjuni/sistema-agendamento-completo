<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    Service::create([
        'name' => 'Corte Masculino',
        'description' => 'Corte tradicional',
        'duration' => 30,
        'price' => 35.00,
        'status' => true,
    ]);

    Service::create([
        'name' => 'Barba',
        'description' => 'Barba completa',
        'duration' => 20,
        'price' => 20.00,
        'status' => true,
    ]);
}
}
