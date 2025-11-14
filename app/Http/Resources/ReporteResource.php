<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReporteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'titulo'      => $this->titulo,
            'descripcion' => $this->descripcion,
            'direccion'   => $this->direccion,
            'latitud'     => $this->latitud,
            'longitud'    => $this->longitud,
            'score'       => $this->score, // accesor
            'prioridad'   => $this->whenLoaded('prioridad', fn() => [
                                'id' => $this->prioridad->id,
                                'nombre' => $this->prioridad->nombre
                              ]),
            'estado'      => $this->whenLoaded('estado', fn() => [
                                'id' => $this->estado->id,
                                'nombre' => $this->estado->nombre
                              ]),
            'usuario'     => $this->whenLoaded('usuario', fn() => [
                                'id' => $this->usuario->id,
                                'nombre' => $this->usuario->nombre
                              ]),
            'fotos'       => $this->whenLoaded('fotos', fn() => $this->fotos->map(fn($f) => [
                                'id' => $f->id, 'url' => $f->url, 'descripcion' => $f->descripcion
                              ])),
            'created_at'  => optional($this->created_at)?->toISOString(),
            'updated_at'  => optional($this->updated_at)?->toISOString(),
        ];
    }
}
