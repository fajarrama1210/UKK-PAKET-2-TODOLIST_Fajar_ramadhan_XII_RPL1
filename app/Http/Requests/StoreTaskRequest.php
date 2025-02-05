<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'priority' => ['required', 'string', 'in:Low,Medium,High'],
            'date' => 'required|date|after_or_equal:today',
            'description' => ['required', 'string', 'max:255', 'min:50'],
            'category_id' => ['required', 'exists:categories,id'],
            'time' => ['required', 'date_format:H:i'],
            'deadline' => 'nullable|date|after_or_equal:today'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Nama tugas harus diisi.',
            'name.string' => 'Nama tugas harus berupa teks.',
            'name.max' => 'Nama tugas tidak boleh lebih dari 255 karakter.',
            'priority.required' => 'Prioritas harus diisi.',
            'priority.string' => 'Prioritas harus berupa teks.',
            'priority.in' => 'Prioritas harus salah satu dari: low, medium, high.',
            'date.required' => 'Tanggal tugas harus diisi.',
            'date.date' => 'Tanggal tugas harus berupa tanggal yang valid.',
            'description.required' => 'Deskripsi tugas harus diisi.',
            'description.string' => 'Deskripsi tugas harus berupa teks.',
            'description.max' => 'Deskripsi tugas tidak boleh lebih dari 255 karakter.',
            'description.min' => 'Deskripsi tugas minimal 50 karakter.',
            'date.after_or_equal' => 'Tanggal tugas tidak boleh diisi dengan tanggal yang sudah lewat (minimal hari ini).',
        ];
    }
}
