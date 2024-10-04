<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajuste conforme sua lógica de autorização
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Para atualizações, a imagem é opcional
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'price.required' => 'O preço do produto é obrigatório.',
            // Adicione outras mensagens personalizadas se necessário
        ];
    }
}
