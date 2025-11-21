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

        return view('reportes.create');
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'titulo' => ['required', 'string', 'max:191'],
        'descripcion' => ['nullable', 'string'],
        'direccion' => ['required', 'string', 'max:255'],
        'latitud' => ['required', 'numeric'],
        'longitud' => ['required', 'numeric'],
        'foto' => ['required', 'image', 'max:10240'], 
    ]);

    
    $data['estado_id'] = 1; 
    $data['prioridad_id'] = 1; 
    $data['usuario_id'] = 1; 

    $reporte = \App\Models\Reporte::create($data);

    // Guardar la imagen
    if ($request->hasFile('foto')) {
        $filename = $reporte->id . '.' . $request->foto->extension();
        $request->foto->storeAs('reportes', $filename);
    }

    return redirect()->route('reportes.mis')->with('success', 'Reporte creado correctamente');
}

    public function edit(Reporte $reporte)
    {
        $usuarios = Usuario::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();

        return view('reportes.edit', compact('reporte','usuarios','prioridades','estados'));
    }

    public function update(Request $request, \App\Models\Reporte $reporte)
    {
    $data = $request->validate([
        'titulo' => ['required','string','max:191'],
        'descripcion' => ['nullable','string'],
        'direccion' => ['nullable','string','max:255'],
        'latitud' => ['required','numeric'],
        'longitud' => ['required','numeric'],
        'foto' => ['nullable','image','max:4096'],
    ]);

    $reporte->update($data);

    if ($request->hasFile('foto')) {
        $filename = $reporte->id.'.'.$request->foto->extension();
        $request->foto->storeAs('public/reportes', $filename);
    }

    return redirect()->route('reportes.mis', $reporte)->with('success','Reporte actualizado');
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        return redirect()->route('reportes.mis')
            ->with('success', 'Reporte eliminado');
    }

    // app/Http/Controllers/ReporteController.php

    public function show(\App\Models\Reporte $reporte)
    {
        $reporte->load([
            'usuario','prioridad','estado',
            'comentarios.usuario', 
            'fotos' 
        ]);

        return view('reportes.ver', compact('reporte'));
    }

    public function atendidos()
    {
    $estadoResuelto = 3;

    $reportes = \App\Models\Reporte::with(['usuario','estado','prioridad'])
        ->where('estado_id', $estadoResuelto)
        ->orderByDesc('created_at')
        ->paginate(10);

    return view('reportes.atendidos', compact('reportes'));
    }

    public function misReportes()
    {
    // Autenticar
    $usuarioId = 1;

    $reportes = \App\Models\Reporte::with(['estado','prioridad'])
        ->where('usuario_id', $usuarioId)
        ->orderByDesc('created_at')
        ->paginate(10);

    return view('reportes.mis', compact('reportes'));   
    }



}
