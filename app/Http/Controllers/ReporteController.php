<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Usuario;
use App\Models\Prioridad;
use App\Models\Estado;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::with(['usuario','prioridad','estado','comentarios.usuario'])
            ->orderBy('id','desc')
            ->paginate(10);

        return view('reportes.index', compact('reportes'));
    }

    public function create()
    {
        // Datos para selects
        $usuarios = Usuario::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();

        return view('reportes.create', compact('usuarios','prioridades','estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'titulo' => 'required|max:191',
            'descripcion' => 'nullable|string',
            'direccion' => 'nullable|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'prioridad_id' => 'required|exists:prioridades,id',
            'estado_id' => 'required|exists:estados,id',
        ]);

        Reporte::create($request->all());

        return redirect()->route('reportes.index')
            ->with('success', 'Reporte creado exitosamente');
    }

    public function edit(Reporte $reporte)
    {
        $usuarios = Usuario::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();

        return view('reportes.edit', compact('reporte','usuarios','prioridades','estados'));
    }

    public function update(Request $request, Reporte $reporte)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'titulo' => 'required|max:191',
            'descripcion' => 'nullable|string',
            'direccion' => 'nullable|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'prioridad_id' => 'required|exists:prioridades,id',
            'estado_id' => 'required|exists:estados,id',
        ]);

        $reporte->update($request->all());

        return redirect()->route('reportes.index')
            ->with('success', 'Reporte actualizado');
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        return redirect()->route('reportes.index')
            ->with('success', 'Reporte eliminado');
    }
}
