<?php

namespace App\Http\Requests;

use id;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        // Jika password baru diinput, kita validasi current_password dan new_password
        if ($this->filled('new_password')) {
            $rules['current_password'] = 'required|current_password'; // Memastikan password lama valid
            $rules['new_password'] = 'required|string|min:8|confirmed'; // Memastikan password baru valid
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama pengguna harus diisi.',
            'email.required' => 'Email harus diisi.',
            'photo.image' => 'File yang diupload harus berupa gambar.',
            'photo.mimes' => 'Foto harus bertipe JPEG, PNG, atau JPG.',
            'photo.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'current_password.required' => 'Password lama harus diisi.',
            'current_password.current_password' => 'Password lama tidak cocok.',
            'new_password.required' => 'Password baru harus diisi.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ];
    }

}
