<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    protected $table = 'prioridades';
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function reportes() { return $this->hasMany(Reporte::class, 'prioridad_id'); }
}
