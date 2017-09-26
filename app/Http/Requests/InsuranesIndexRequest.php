<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsuranesIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'birthdate' => 'required|numeric|between:-2147483649,2147483648',
            'range' => 'required|in:single,familie,partner,alleinerziehende',
            'has_previous' => 'required|boolean',
            'had_damage' => 'required|boolean',
        ];
    }
}
