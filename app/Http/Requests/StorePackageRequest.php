<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|max:20|unique:packages,code',
            'name' => 'required|string|max:255',
            'download_kbps' => 'required|integer|min:1',
            'upload_kbps' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'ppn' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ];
    }
}