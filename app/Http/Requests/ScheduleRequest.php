<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determina se o usuário pode realizar esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação.
     */
    public function rules(): array
{
    return [

        'is_open' => [
            'required',
            'boolean'
        ],

        'start_time' => [
            'nullable',
            'date_format:H:i'
        ],

        'end_time' => [
            'nullable',
            'date_format:H:i'
        ],

        'break_start' => [
            'nullable',
            'date_format:H:i'
        ],

        'break_end' => [
            'nullable',
            'date_format:H:i'
        ],

    ];
}

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [

            'is_open.required' =>
                'Informe se o dia estará aberto.',

            'is_open.boolean' =>
                'Valor inválido para o status do dia.',

            'start_time.required_if' =>
                'Informe o horário de abertura.',

            'start_time.date_format' =>
                'O horário de abertura é inválido.',

            'end_time.required_if' =>
                'Informe o horário de fechamento.',

            'end_time.date_format' =>
                'O horário de fechamento é inválido.',

            'end_time.after' =>
                'O horário de fechamento deve ser maior que o horário de abertura.',

            'break_start.date_format' =>
                'O horário inicial do intervalo é inválido.',

            'break_start.after' =>
                'O início do intervalo deve ser após a abertura.',

            'break_start.before' =>
                'O início do intervalo deve ser antes do fechamento.',

            'break_end.date_format' =>
                'O horário final do intervalo é inválido.',

            'break_end.after' =>
                'O fim do intervalo deve ser após o início do intervalo.',

            'break_end.before' =>
                'O fim do intervalo deve ser antes do fechamento.',
        ];
    }
}
