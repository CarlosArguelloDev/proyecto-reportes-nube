<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    public $timestamps = false;

    protected $fillable = ['nombre','email','telefono','contrasena','created_at'];
    protected $hidden = ['contrasena'];

    public function reportes() { return $this->hasMany(Reporte::class, 'usuario_id'); }
}
