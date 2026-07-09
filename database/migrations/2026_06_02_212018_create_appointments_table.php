<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->constrained()
                ->cascadeOnDelete();

            // Data do agendamento
            $table->date('appointment_date');

            // Horário do agendamento
            $table->time('appointment_time');

            /*
            |--------------------------------------------------------------------------
            | Duração do serviço no momento do agendamento.
            | Mantém o histórico mesmo que a duração do serviço seja alterada futuramente.
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('duration');

            // Status do agendamento
            $table->string('status')
                ->default('pending');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
