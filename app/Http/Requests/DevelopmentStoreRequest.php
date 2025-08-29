<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DevelopmentStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required|string',
            'description' => 'required|string',
            'person_in_charge' => 'required|string',
            'start_date' => 'date',
            'end_date' => 'date',
            'amount' => 'required|integer',
            'status' => 'required|in:ongoing,completed',
        ];
    }
    public function attributes()
    {
        return [
            'thumbnail' => 'Thumbnail',
            'name' => 'Nama Pembangunan',
            'description' => 'Deskripsi Pembangunan',
            'person_in_charge' => 'Penanggung Jawab',
            'date' => 'Tanggal Mulai Pembangunan',
            'time' => 'Tanggal Berakhir Pembangunan',
            'amount' => 'Jumlah Dana',
            'status' => 'Status',
        ];
    }
}
