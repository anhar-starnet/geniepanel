<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'customer_code' => [
                'required',
                Rule::unique('customers', 'customer_code')
                    ->ignore($this->customer),
            ],

            'package_id' => 'nullable|exists:packages,id',

            'name' => 'required|string|max:100',
            'nik' => 'nullable|string|max:30',

            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',

            'address' => 'nullable|string',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            'pppoe_username' => 'nullable|string|max:100',
            'pppoe_password' => 'nullable|string|max:100',

            'serial_number' => 'nullable|string|max:100',

            'status' => 'required|in:active,suspend,terminated',

        ];
    }
}