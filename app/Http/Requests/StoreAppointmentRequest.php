<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check();
    }



    public function rules(): array
    {
        return [

            'service_id' => [

                'required',

                'exists:services,id',

            ],


            'appointment_date' => [

                'required',

                'date',

            ],


            'appointment_time' => [

                'required',

                'date_format:H:i',

            ],

        ];
    }



    public function messages(): array
    {
        return [

            'service_id.required' =>
                'Selecione um serviço.',


            'service_id.exists' =>
                'Serviço inválido.',


            'appointment_date.required' =>
                'Informe a data.',


            'appointment_date.date' =>
                'Data inválida.',


            'appointment_time.required' =>
                'Informe o horário.',


            'appointment_time.date_format' =>
                'Horário inválido.',

        ];
    }
}
