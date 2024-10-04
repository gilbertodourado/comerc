<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'neighborhood' => 'required|string',
            'zip_code' => 'required|string',
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