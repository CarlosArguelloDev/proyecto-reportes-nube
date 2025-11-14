<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReporteRequest extends FormRequest
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
            'usuario_id'   => ['required','integer','exists:usuarios,id'],
            'titulo'       => ['required','string','max:191'],
            'descripcion'  => ['nullable','string'],
            'direccion'    => ['nullable','string','max:255'],
            'latitud'      => ['nullable','numeric','between:-90,90'],
            'longitud'     => ['nullable','numeric','between:-180,180'],
            'prioridad_id' => ['required','integer','exists:prioridades,id'],
            'estado_id'    => ['required','integer','exists:estados,id'],
        ];
    }
}
