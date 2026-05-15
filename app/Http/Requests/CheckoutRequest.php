<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0.01',
            'paid' => 'required|numeric|min:0.01',
            'change' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'items.required' => 'Keranjang tidak boleh kosong.',
            'items.min' => 'Minimal 1 produk harus dipilih.',
            'items.*.product_id.required' => 'ID produk wajib diisi.',
            'items.*.product_id.exists' => 'Produk tidak ditemukan.',
            'items.*.qty.required' => 'Jumlah produk wajib diisi.',
            'items.*.qty.min' => 'Jumlah produk minimal 1.',
            'total.required' => 'Total harga wajib diisi.',
            'total.numeric' => 'Total harga harus berupa angka.',
            'total.min' => 'Total harga minimal Rp 0,01.',
            'paid.required' => 'Jumlah pembayaran wajib diisi.',
            'paid.numeric' => 'Jumlah pembayaran harus berupa angka.',
            'paid.min' => 'Jumlah pembayaran minimal Rp 0,01.',
            'change.required' => 'Kembalian wajib diisi.',
            'change.numeric' => 'Kembalian harus berupa angka.',
            'change.min' => 'Kembalian tidak boleh negatif.',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $paid = $this->input('paid', 0);
            $total = $this->input('total', 0);

            if ($paid < $total) {
                $validator->errors()->add('paid', 'Uang pembayaran tidak mencukupi. Kekurangan: Rp ' . number_format($total - $paid, 0, ',', '.'));
            }
        });
    }
}