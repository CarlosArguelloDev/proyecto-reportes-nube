<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReporteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usuario_id'   => ['sometimes','integer','exists:usuarios,id'],
            'titulo'       => ['sometimes','string','max:191'],
            'descripcion'  => ['sometimes','nullable','string'],
            'direccion'    => ['sometimes','nullable','string','max:255'],
            'latitud'      => ['sometimes','nullable','numeric','between:-90,90'],
            'longitud'     => ['sometimes','nullable','numeric','between:-180,180'],
            'prioridad_id' => ['sometimes','integer','exists:prioridades,id'],
            'estado_id'    => ['sometimes','integer','exists:estados,id'],
        ];
    }
}
