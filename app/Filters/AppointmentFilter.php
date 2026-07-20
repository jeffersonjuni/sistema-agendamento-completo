<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;


class AppointmentFilter
{


    public function apply(
        Builder $query,
        array $filters
    ): Builder {


        /*
        |--------------------------------------------------------------------------
        | Filtro por status
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['status'])
        ) {


            $query->where(
                'status',
                $filters['status']
            );


        }





        /*
        |--------------------------------------------------------------------------
        | Busca por cliente
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['client'])
        ) {


            $query->whereHas(
                'user',
                function ($query) use ($filters) {


                    $query->where(
                        'name',
                        'like',
                        '%' . $filters['client'] . '%'
                    );


                }
            );


        }





        /*
        |--------------------------------------------------------------------------
        | Busca por serviço
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['service'])
        ) {


            $query->whereHas(
                'service',
                function ($query) use ($filters) {


                    $query->where(
                        'name',
                        'like',
                        '%' . $filters['service'] . '%'
                    );


                }
            );


        }





        /*
        |--------------------------------------------------------------------------
        | Período inicial
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['start_date'])
        ) {


            $query->whereDate(
                'appointment_date',
                '>=',
                $filters['start_date']
            );


        }





        /*
        |--------------------------------------------------------------------------
        | Período final
        |--------------------------------------------------------------------------
        */

        if (
            !empty($filters['end_date'])
        ) {


            $query->whereDate(
                'appointment_date',
                '<=',
                $filters['end_date']
            );


        }





        return $query;


    }


}
