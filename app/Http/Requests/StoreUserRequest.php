<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:12',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama pengguna harus diisi.',
            'name.string' => 'Nama pengguna harus berupa string.',
            'name.max' => 'Nama pengguna tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan.',

            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.string' => 'Nomor telepon harus berupa string.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 12 karakter.',

            'photo.image' => 'File yang diupload harus berupa gambar.',
            'photo.mimes' => 'Foto harus bertipe JPEG, PNG, atau JPG.',
            'photo.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ];
    }
    }
