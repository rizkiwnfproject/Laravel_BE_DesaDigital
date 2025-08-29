<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeadOfFamilyStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'identity_number' => 'required|integer',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string',
            'occupation' => 'required|string',
            'marital_status' => 'required|string|in:single,married',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Kata Sandi',
            'profile_picture' => 'Foto Profil',
            'identity_number' => 'Nomor Identitas',
            'gender' => 'Jenis Kelamin',
            'date_of_birth' => 'Tanggal Lahir',
            'phone_number' => 'Npmor Telepon',
            'occupation' => 'Pekerjaan',
            'marital_status' => 'Status Perkawinan',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'required' => ':attribute harus diisi',
    //         'string' => ':attribute harus berupa string',
    //         'max' => ':attribute maksimal :max karakter ',
    //         'max:2048' => ':attribute maksimal 2048 KB  ',
    //         'min' => ':attribute minimal :min karakter ',
    //         'unique' => ':attribute sudah ada',
    //         'unique:users' => ':attribute sudah ada',
    //         'email' => ':attribute harus berupa email',
    //         'exists' => ':attribute tidak ditemukan',
    //         'integer' => ':attribute harus berupa integer',
    //         'array' => ':attribute harus berupa array',
    //         'mimes' => ':attribute harus berupa jpeg,png,jpg',
    //         'in' => ':attribute harus berupa salah satu dari :values',
    //     ];
    // }
}
