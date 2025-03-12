<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BMIRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>  ['required', 'string', 'max:255'],
            'gender' =>  ['required', 'in:male,female'],
            'weight' =>  ['required', 'numeric', 'min:1'],
            'height' =>  ['required', 'numeric', 'min:1'],
        ];
    }
}
