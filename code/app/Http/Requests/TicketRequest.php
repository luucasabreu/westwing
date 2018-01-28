<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TicketRequest extends FormRequest
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
            'name' => 'required|max:120',
            'email' => 'required|email|max:120',
            'number' => 'required|int',
            'title' => 'required|max:120',
            'note' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required'      => 'O campo :attribute é obrigatório',
            'max'           => 'O campo :attribute pode ter no máximo :max caracteres',
            'email'         => 'O campo :attribute é inválido',
        ];
    }

    public function attributes()
    {
        return [
            'name'      => 'Nome do Cliente',
            'email'     => 'E-mail',
            'number'    => 'N° do Pedido',
            'title'     => 'Título',
            'note'      => 'Observações'
        ];
    }
}