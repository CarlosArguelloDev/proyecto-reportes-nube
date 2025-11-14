<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function reportes() { return $this->hasMany(Reporte::class, 'estado_id'); }
}
