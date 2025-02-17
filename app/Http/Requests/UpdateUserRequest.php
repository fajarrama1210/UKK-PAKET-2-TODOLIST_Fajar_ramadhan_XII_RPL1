<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('user')->id,
            'phone' => 'required|string|max:12',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Pesan kesalahan validasi.
     */
    public function messages()
    {
        return [
            'name.required' => 'Nama pengguna harus diisi.',
            'email.required' => 'Email harus diisi.',
            'photo.image' => 'File yang diupload harus berupa gambar.',
            'photo.mimes' => 'Foto harus bertipe JPEG, PNG, atau JPG.',
            'photo.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 12 karakter.',
        ];
    }
}
