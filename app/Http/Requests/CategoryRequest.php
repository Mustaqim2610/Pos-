<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Authorize the request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:categories,name,' . $this->category,
            'description' => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom Messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori sudah tersedia.',
            'name.max' => 'Nama kategori maksimal 100 karakter.',
        ];
    }
}