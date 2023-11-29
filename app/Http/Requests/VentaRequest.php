<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
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
            'venta_id' => 'required|numeric|unique:ventas',
            'cliente_id' => 'required|numeric',
            'fecha_venta' => 'required|string|max:50',
            'papitafrita_id' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'precio_unitario' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'venta_id.required' => 'El ID es obligatorio.',
            'venta_id.unique' => 'El ID ya ha sido utilizado',
            'venta_id.numeric' => 'El ID debe ser numérico.',
            'cliente_id.required' => 'El campo cliente es obligatorio.',
            'cliente_id.numeric' => 'El campo cliente debe ser númerico.',
            'fecha_venta.required' => 'El campo fecha venta es obligatorio.',
            'papitafrita_id.required' => 'El campo empleado es obligatorio.',
            'papitafrita_id.numeric' => 'El campo producto debe ser númerico.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.required' => 'El campo cantidad debe ser númerico.',
            'precio_unitario.required' => 'El campo precio unitario es obligatorio.',
            'precio_unitario.numeric' => 'El campo precio unitario debe ser númerico.',
        ];
    }
}
