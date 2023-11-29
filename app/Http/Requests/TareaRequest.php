<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TareaRequest extends FormRequest
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
            'tarea_id' => 'required|numeric|unique:tareas',
            'descripcion' => 'required|string|max:255',
            'fecha_asignacion' => 'required|string|max:50',
            'emp_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'tarea_id.required' => 'El ID es obligatorio.',
            'tarea_id.unique' => 'El ID ya ha sido utilizado',
            'tarea_id.numeric' => 'El ID debe ser un valor numérico.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'fecha_asignacion.required' => 'El fecha_asignacion es obligatorio.',
            'emp_id.required' => 'El campo empleado es obligatorio.',
            'emp_id.numeric' => 'El empleado elegido no debe ser vacio.',
        ];
    }
}
