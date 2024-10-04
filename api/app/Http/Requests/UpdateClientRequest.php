<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:clients,email,' . $this->client->id,
            'phone' => 'sometimes|required|string',
            'birth_date' => 'sometimes|required|date',
            'address' => 'sometimes|required|string',
            'neighborhood' => 'sometimes|required|string',
            'zip_code' => 'sometimes|required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Este e-mail já está cadastrado.',
            // Adicione outras mensagens personalizadas se necessário
        ];
    }
}
