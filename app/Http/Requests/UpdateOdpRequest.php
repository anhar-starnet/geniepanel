<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOdpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        $odp = $this->route('odp');

        return [

            'pop_id' => 'required|exists:pops,id',

            'code' => 'required|string|max:20|unique:odps,code,' . $odp->id,

            'name' => 'required|string|max:100',

            'distribution_type' => 'required|in:AERIAL,UNDERGROUND',

            'port_capacity' => 'required|integer|min:1',

            'used_ports' => 'required|integer|min:0',

            'fiber_core' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'latitude' => 'nullable|numeric|between:-90,90',

            'longitude' => 'nullable|numeric|between:-180,180',

            'description' => 'nullable|string',

            'status' => 'required|boolean',

        ];
    }
}