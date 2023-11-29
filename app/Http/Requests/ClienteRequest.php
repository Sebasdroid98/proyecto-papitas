<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_id' => 'required|numeric|unique:clientes',
            'nombre' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'cliente_id.required' => 'El ID es obligatorio.',
            'cliente_id.unique' => 'El ID ya ha sido utilizado.',
            'cliente_id.numeric' => 'El ID debe ser un valor numérico.',
            'nombre.required' => 'El campo descripción es obligatorio.',
            'direccion.required' => 'El fecha_asignacion es obligatorio.',
        ];
    }
}
