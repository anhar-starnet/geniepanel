<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOntRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'splitter_port_id' => [
                'nullable',
                'exists:splitter_ports,id',
            ],

            'code' => [
                'required',
                'max:50',
                Rule::unique('onts', 'code')->ignore($this->ont),
            ],

            'vendor' => [
                'required',
                'max:100',
            ],

            'model' => [
                'required',
                'max:100',
            ],

            'serial_number' => [
                'required',
                'max:100',
                Rule::unique('onts', 'serial_number')->ignore($this->ont),
            ],

            'firmware' => [
                'nullable',
                'max:100',
            ],

            'genieacs_device_id' => [
                'nullable',
                'max:255',
                Rule::unique('onts', 'genieacs_device_id')->ignore($this->ont),
            ],

            'status' => [
                'boolean',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

        ];
    }
}