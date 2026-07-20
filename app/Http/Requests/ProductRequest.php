<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:kategoris,id',
            'name'        => 'required|string|max:150',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori tidak valid.',
            'name.required'        => 'Nama produk wajib diisi.',
            'price.required'       => 'Harga wajib diisi.',
            'price.numeric'        => 'Harga harus berupa angka.',
            'stock.required'       => 'Stok wajib diisi.',
            'stock.integer'        => 'Stok harus berupa angka.',
            'photo.image'          => 'File harus berupa gambar.',
            'photo.mimes'          => 'Format gambar: JPG, PNG, atau WebP.',
            'photo.max'            => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
