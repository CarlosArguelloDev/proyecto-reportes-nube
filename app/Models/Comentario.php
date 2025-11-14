<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
        protected $table = 'comentarios';
    public $timestamps = false;
    protected $fillable = ['reporte_id','usuario_id','texto','publico','created_at'];
    protected $casts = ['publico' => 'bool'];

    public function reporte() { return $this->belongsTo(Reporte::class, 'reporte_id'); }
    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id'); }
}
