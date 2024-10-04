<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Você pode adicionar lógica de autorização se necessário
    }

    public function rules()
    {
        return [
            'client_id' => 'sometimes|required|exists:clients,id', // Somente quando o campo é enviado
            'product_ids' => 'sometimes|required|array',
            'product_ids.*' => 'exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'O ID do cliente é obrigatório.',
            'client_id.exists' => 'O cliente informado não existe.',
            'product_ids.required' => 'Os IDs dos produtos são obrigatórios.',
            'product_ids.array' => 'Os IDs dos produtos devem ser um array.',
            'product_ids.*.exists' => 'Um ou mais produtos informados não existem.',
        ];
    }
}
