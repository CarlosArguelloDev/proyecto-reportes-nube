<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{

    protected $table = 'reportes';
    public $timestamps = false; 

    // Campos permitidos para asignación masiva 
    protected $fillable = [
        'usuario_id',
        'titulo',
        'descripcion',
        'direccion',
        'latitud',
        'longitud',
        'prioridad_id',
        'estado_id',
     ];
    // Conversión de tipos
      protected $casts = [
        'latitud'    => 'float',
        'longitud'   => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

        // Relaciones
    public function usuario()   { return $this->belongsTo(Usuario::class, 'usuario_id'); }
    public function prioridad() { return $this->belongsTo(Prioridad::class, 'prioridad_id'); }
    public function estado()    { return $this->belongsTo(Estado::class, 'estado_id'); }
    public function fotos()     { return $this->hasMany(Foto::class, 'reporte_id'); }
    public function comentarios(){ return $this->hasMany(Comentario::class, 'reporte_id'); }
    public function votos()     { return $this->hasMany(Voto::class, 'reporte_id'); }

    //puntaje por votos
    public function getScoreAttribute()
    {
        return (int) $this->votos()->sum('valor');
    }   
}
