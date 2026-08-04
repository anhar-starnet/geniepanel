<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Apakah user diizinkan?
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validasi input customer.
     */
    public function rules(): array
    {
        return [

            'customer_code' => 'required|string|max:20|unique:customers,customer_code',

            'name' => 'required|string|max:100',

            'nik' => 'nullable|string|max:30',

            'phone' => 'nullable|string|max:30',

            'email' => 'nullable|email|max:255',

            'address' => 'nullable|string',

            'latitude' => 'nullable|numeric',

            'longitude' => 'nullable|numeric',

            'package_id' => 'nullable|exists:packages,id',

            'pop_id' => 'nullable|exists:pops,id',

            'odp_id' => 'nullable|exists:odps,id',

            'ont_id' => 'nullable|exists:onts,id',

            'service_type' => 'required|in:PPPOE,STATIC,HOTSPOT',

            'pppoe_username' => 'nullable|string|max:100',

            'pppoe_password' => 'nullable|string|max:100',

            'serial_number' => 'nullable|string|max:100',

            'status' => 'nullable|in:active,suspend,terminated',

        ];
    }

    /**
     * Nama field.
     */
    public function attributes(): array
    {
        return [

            'customer_code' => 'Kode Customer',

            'name' => 'Nama Customer',

            'nik' => 'NIK',

            'phone' => 'Nomor HP',

            'email' => 'Email',

            'address' => 'Alamat',

            'latitude' => 'Latitude',

            'longitude' => 'Longitude',

            'package_id' => 'Paket Internet',

            'pop_id' => 'POP',

            'odp_id' => 'ODP',

            'ont_id' => 'ONT',

            'service_type' => 'Jenis Layanan',

            'pppoe_username' => 'Username PPPoE',

            'pppoe_password' => 'Password PPPoE',

            'serial_number' => 'Serial Number',

            'status' => 'Status',

        ];
    }
}