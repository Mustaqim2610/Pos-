<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    /**
     * Authorize Request.
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
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'payment' => 'required|numeric|min:0',
        ];
    }

    /**
     * Validation Messages.
     */
    public function messages(): array
    {
        return [
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists' => 'Produk tidak ditemukan.',

            'qty.required' => 'Jumlah pembelian wajib diisi.',
            'qty.integer' => 'Jumlah harus berupa angka.',
            'qty.min' => 'Minimal pembelian 1 produk.',

            'payment.required' => 'Nominal pembayaran wajib diisi.',
            'payment.numeric' => 'Pembayaran harus berupa angka.',
        ];
    }

    /**
     * Additional Validation.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $product = \App\Models\Product::find($this->product_id);

            if ($product && $this->qty > $product->stock) {
                $validator->errors()->add(
                    'qty',
                    'Stok produk tidak mencukupi.'
                );
            }
        });
    }
}