<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AppointmentsExport implements
    FromCollection,
    WithHeadings,
    WithMapping
{

    private Collection $appointments;


    public function __construct(
        Collection $appointments
    ) {

        $this->appointments = $appointments;

    }



    /**
     * Dados que serão exportados
     */
    public function collection()
    {
        return $this->appointments;
    }



    /**
     * Cabeçalho da planilha
     */
    public function headings(): array
    {

        return [

            'ID',

            'Cliente',

            'Serviço',

            'Data',

            'Horário',

            'Status',

            'Valor',

        ];

    }



    /**
     * Formatação das linhas
     */
    public function map($appointment): array
    {

        return [

            $appointment->id,


            $appointment->user?->name
            ?? 'Cliente não informado',


            $appointment->service?->name
            ?? 'Serviço não informado',


            $appointment->appointment_date
                ->format('d/m/Y'),


            $appointment->appointment_time,


            $appointment->status->label(),


            number_format(
                $appointment->service?->price ?? 0,
                2,
                ',',
                '.'
            ),

        ];

    }

}
