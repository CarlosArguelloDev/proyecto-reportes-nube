<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZonaController extends Controller
{
    public function index()
{
    // Zonas
    $zonas = [
        ['id'=>'SJR','title'=>'San Juan del Río','lat'=>20.398989,'lng'=>-99.9731976,'zoom'=>12.98],
        ['id'=>'Oriente','title'=>'Zona Oriente','lat'=>20.383161,'lng'=>-99.949602,'zoom'=>14],
        ['id'=>'Centro','title'=>'Zona Centro','lat'=>20.388966,'lng'=>-99.996473,'zoom'=>15],
    ];

    // Reportes
    $reportes = \App\Models\Reporte::query()
        ->select('id','titulo','latitud','longitud','direccion','estado_id','prioridad_id','created_at')
        ->whereNotNull('latitud')
        ->whereNotNull('longitud')
        ->get()
        ->map(function ($r) {
            return [
                'id'          => $r->id,
                'titulo'      => $r->titulo,
                'lat'         => (float) $r->latitud,
                'lng'         => (float) $r->longitud,
                'direccion'   => $r->direccion,
                'estado_id'   => $r->estado_id,
                'prioridad_id'=> $r->prioridad_id,
                'fecha'       => optional($r->created_at)->format('d/m/Y H:i'),
                'url'         => route('reportes.show', $r->id),
                'img'         => asset('storage/reportes/'.$r->id.'.jpg'),
            ];
        });

    return view('zonas.index', compact('zonas','reportes'));
}
}