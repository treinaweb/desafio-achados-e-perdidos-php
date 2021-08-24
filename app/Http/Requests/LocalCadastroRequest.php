<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalCadastroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'local.nome' => ['required', 'string', 'max:255'],
            'local.endereco' => ['required', 'string', 'max:255'],
            'local.contato' => ['required', 'string', 'max:255'],
            'local.descricao' => ['required', 'string', 'max:255'],

            'usuario.nome' => ['required', 'string', 'max:255'],
            'usuario.email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:App\Models\User,email'
            ],
            'usuario.password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }
}
