<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoUpdateRequest extends FormRequest
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
            'emp_id' => 'required|numeric',
            'nombre' => 'required|string|max:100',
            'cargo' => 'required|string|max:50',
            'salario' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'emp_id.required' => 'El ID es obligatorio.',
            'emp_id.numeric' => 'El ID debe ser un valor numérico.',
            'salario.required' => 'El salario es obligatorio.',
            'salario.numeric' => 'El salario debe ser un valor numérico.',
            'nombre.required' => 'El nombre es obligatorio.',
            'cargo.required' => 'El cargo es obligatorio.',
        ];
    }
}
