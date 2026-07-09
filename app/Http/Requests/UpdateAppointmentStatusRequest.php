<?php

namespace App\Http\Requests;

use App\Enums\AppointmentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateAppointmentStatusRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }



    public function rules(): array
    {
        return [

            'status' => [

                'required',

                new Enum(
                    AppointmentStatus::class
                ),

            ],

        ];
    }



    public function messages(): array
    {
        return [

            'status.required' =>
                'Informe o status.',


            'status.enum' =>
                'Status inválido.',

        ];
    }
}
