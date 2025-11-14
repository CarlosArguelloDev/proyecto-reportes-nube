<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'fotos';
    public $timestamps = false;
    protected $fillable = ['reporte_id','url','descripcion','created_at'];

    public function reporte() { return $this->belongsTo(Reporte::class, 'reporte_id'); }
}
