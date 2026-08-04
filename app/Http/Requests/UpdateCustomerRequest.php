<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Apakah user diizinkan?
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validasi update customer
     */
    public function rules(): array
    {
        return [

            'customer_code' => [
                'required',
                Rule::unique('customers', 'customer_code')
                    ->ignore($this->customer),
            ],

            'name' => 'required|string|max:100',

            'nik' => 'nullable|string|max:30',

            'phone' => 'nullable|string|max:30',

            'email' => 'nullable|email|max:255',

            'address' => 'nullable|string',

            'latitude' => 'nullable|numeric',

            'longitude' => 'nullable|numeric',

            'package_id' => 'nullable|exists:packages,id',

            'ont_id' => 'nullable|exists:onts,id',

            'service_type' => 'required|in:PPPOE,STATIC,HOTSPOT',

            'pppoe_username' => 'nullable|string|max:100',

            'pppoe_password' => 'nullable|string|max:100',

            'status' => 'required|in:active,suspend,terminated',

        ];
    }

    /**
     * Nama field
     */
    public function attributes(): array
    {
        return [

            'customer_code'   => 'Kode Customer',

            'name'            => 'Nama Customer',

            'nik'             => 'NIK',

            'phone'           => 'Nomor HP',

            'email'           => 'Email',

            'address'         => 'Alamat',

            'package_id'      => 'Paket Internet',

            'ont_id'          => 'ONT',

            'service_type'    => 'Jenis Layanan',

            'pppoe_username'  => 'Username',

            'pppoe_password'  => 'Password',

        ];
    }
}