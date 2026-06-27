<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $input = $this->all();

        array_walk($input, function (&$val) {
            if (is_string($val)) {
                $val = trim(strip_tags($val));
            }
        });

        $this->merge($input);
    }

    public function rules()
    {
        return [
            "name" => "required|string|max:255",
            "stock" => "required|integer|min:0",
            "price" => "required|numeric|min:0",
            "category_id" => "required|exists:categories,id",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Nama item wajib diisi.",
            "stock.required" => "Stok item wajib diisi.",
            "stock.integer" => "Stok item harus berupa angka.",
            "price.required" => "Harga item wajib diisi.",
            "price.numeric" => "Harga item harus berupa angka.",
            "category_id.required" => "Kategori wajib dipilih.",
            "category_id.exists" => "Kategori tidak ditemukan.",
        ];
    }
}