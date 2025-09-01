<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
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
            'about' => 'required|string',
            'headman' => 'required|string',
            'people' => 'required|integer',
            'agricultural_area' => 'required',
            'total_area' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
    public function attributes()
    {
        return [
            'thumbnail' => 'thumbnail',
            'name' => 'nama',
            'about' => 'deskripsi',
            'headman' => 'kepala desa',
            'people' => 'jumlah penduduk',
            'agricultural_area' => 'luas pertanian',
            'total_area' => 'total area',
            'images' => 'gambar'
        ];
    }
}
