<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubKategoriRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' =>  ['required', 'string', 'max:255'],
            'kategori_id' =>  ['required'],
        ];
    }
}
