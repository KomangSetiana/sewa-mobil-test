<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStroreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required',
            'model' => 'required',
            'license_plate' => 'required|unique:cars',
            'daily_rate' => 'required|numeric',
        ];
    }
}
