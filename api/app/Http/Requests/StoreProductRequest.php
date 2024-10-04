<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajuste conforme sua lógica de autorização
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Tamanho máximo da imagem em KB
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'price.required' => 'O preço do produto é obrigatório.',
            'image.required' => 'A foto do produto é obrigatória.',
        ];
    }
}
