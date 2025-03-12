<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TextComparisonRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'input1' =>  ['required', 'string', 'max:255'],
            'input2' =>  ['required', 'string', 'max:255'],
        ];
    }
}
