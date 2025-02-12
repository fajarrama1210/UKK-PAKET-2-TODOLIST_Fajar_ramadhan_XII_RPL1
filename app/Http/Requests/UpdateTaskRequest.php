<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'name'         => 'required|string|max:255',
            'priority'     => 'required|in:Low,Medium,High',
            'description'  => 'required|string|max:255|min:50',
            'category_id'  => 'required|exists:categories,id',
            'date'         => 'required|date', // aturan after_or_equal:today dihapus
            'time'         => ['required', 'date_format:H:i'],
            'status'       => 'required|in:pending,In Progress,completed',
            'deadline'     => 'nullable|date', // aturan after_or_equal:today dihapus
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Nama tugas harus diisi.',
            'name.string'          => 'Nama tugas harus berupa teks.',
            'name.max'             => 'Nama tugas tidak boleh lebih dari 255 karakter.',
            'priority.required'    => 'Prioritas harus diisi.',
            'priority.in'          => 'Prioritas harus salah satu dari: low, medium, high.',
            'date.required'        => 'Tanggal tugas harus diisi.',
            'date.date'            => 'Tanggal tugas harus berupa tanggal yang valid.',
            // pesan after_or_equal untuk date telah dihapus
            'time.required'        => 'Jam tugas harus diisi.',
            'time.date_format'     => 'Jam tugas harus dalam format H:i (contoh: 14:30).',
            'description.required' => 'Deskripsi tugas harus diisi.',
            'description.string'   => 'Deskripsi tugas harus berupa teks.',
            'description.max'      => 'Deskripsi tugas tidak boleh lebih dari 255 karakter.',
            'description.min'      => 'Deskripsi tugas minimal 50 karakter.',
            'status.in'          => 'Status tugas harus salah satu dari: pending, inprogress, completed.',
            // pesan after_or_equal untuk deadline telah dihapus
            'deadline.date'        => 'Tanggal deadline harus berupa tanggal yang valid.',
        ];
    }
}
