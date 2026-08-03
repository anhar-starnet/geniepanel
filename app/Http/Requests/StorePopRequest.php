<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'area_id' => 'required|exists:areas,id',

            'code' => 'required|string|max:20|unique:pops,code',

            'name' => 'required|string|max:100',

            'address' => 'nullable|string',

            'latitude' => 'nullable|numeric|between:-90,90',

            'longitude' => 'nullable|numeric|between:-180,180',

            'description' => 'nullable|string',

            'status' => 'required|boolean',

        ];
    }
}