<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $table = 'votos';
    public $timestamps = false;
    protected $fillable = ['reporte_id','usuario_id','valor','created_at'];

    public function reporte() { return $this->belongsTo(Reporte::class, 'reporte_id'); }
    public function usuario() { return $this->belongsTo(Usuario::class, 'usuario_id'); }
}
