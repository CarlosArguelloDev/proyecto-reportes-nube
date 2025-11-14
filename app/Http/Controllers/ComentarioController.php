<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request, Reporte $reporte)
    {
        // Si tienes login con usuarios de Laravel, usamos el usuario logueado;
        // si no, permitimos que venga usuario_id en la forma.
        $rules = [
            'texto'   => ['required','string','max:5000'],
            'publico' => ['nullable','boolean'],
        ];

        if (!Auth::check()) {
            $rules['usuario_id'] = ['required','integer','exists:usuarios,id'];
        }

        $data = $request->validate($rules);

        $comentario = new Comentario();
        $comentario->reporte_id = $reporte->id;
        $comentario->texto      = $data['texto'];
        $comentario->publico    = $data['publico'] ?? true;
        $comentario->usuario_id = Auth::id() ?? $data['usuario_id']; // soporte ambos casos
        $comentario->save();

        return back()->with('success', 'Comentario agregado')
                     ->with('open_comments', $reporte->id); // reabrir colapso
    }

    public function destroy(Comentario $comentario)
    {
        // Aquí podrías validar permisos (propietario/admin).
        $comentario->delete();
        return back()->with('success', 'Comentario eliminado')
                     ->with('open_comments', $comentario->reporte_id);
    }
}
