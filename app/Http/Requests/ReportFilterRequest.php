<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\AppointmentStatus;

class ReportFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'status' => [
                'nullable',
                Rule::in(
                    array_column(
                        AppointmentStatus::cases(),
                        'value'
                    )
                ),
            ],

            'client' => [
                'nullable',
                'string',
                'max:255',
            ],

            'service' => [
                'nullable',
                'string',
                'max:255',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

        ];
    }
}
