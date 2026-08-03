<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOntRequest extends FormRequest
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
                'unique:onts,code',
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
                'unique:onts,serial_number',
            ],

            'firmware' => [
                'nullable',
                'max:100',
            ],

            'genieacs_device_id' => [
                'nullable',
                'max:255',
                'unique:onts,genieacs_device_id',
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