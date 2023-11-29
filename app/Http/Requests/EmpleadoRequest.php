<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
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
            'emp_id' => 'required|numeric|unique:empleados',
            'nombre' => 'required|string|max:100',
            'cargo' => 'required|string|max:50',
            'salario' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'emp_id.required' => 'El ID es obligatorio.',
            'emp_id.unique' => 'El ID ya ha sido utilizado',
            'emp_id.numeric' => 'El ID debe ser un valor numérico.',
            'salario.required' => 'El salario es obligatorio.',
            'salario.numeric' => 'El salario debe ser un valor numérico.',
            'nombre.required' => 'El nombre es obligatorio.',
            'cargo.required' => 'El cargo es obligatorio.',
            'email.required' => 'El campo E-mail es obligatorio.',
            'email.email' => 'El campo E-mail debe ser de tipo texto.',
            'email.unique' => 'El E-mail suministrado ya esta registrado.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.min' => 'El campo Contraseña debe ser minimo de 8 caracteres.',
        ];
    }
}
