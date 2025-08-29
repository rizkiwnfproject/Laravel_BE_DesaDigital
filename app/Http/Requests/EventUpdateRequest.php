<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required',
            'is_active' => 'boolean',
        ];
    }

    public function attributes()
    {
        return [
            'thumbnail' => 'Thumbnail',
            'name' => 'Nama Kegiatan',
            'description' => 'Deskripsi Kegiatan',
            'price' => 'Harga Kegiatan',
            'date' => 'Jadwal Kegiatan',
            'time' => 'Waktu Kegiatan',
            'is_active' => 'Status',
        ];
    }
}
