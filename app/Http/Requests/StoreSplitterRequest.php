<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSplitterRequest extends FormRequest
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
        return [

            'odp_id' => 'required|exists:odps,id',

            'code' => 'required|string|max:20|unique:splitters,code',

            'name' => 'required|string|max:100',

            'ratio' => 'required|in:1:2,1:4,1:8,1:16,1:32,1:64',

            'description' => 'nullable|string',

            'status' => 'required|boolean',

        ];
    }
}