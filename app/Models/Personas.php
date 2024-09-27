<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento', 'pnombre', 'snombre', 'papellido', 'sapellido',
        'telefono', 'correo', 'direccion', 'rol_id', 'tipo_sangre_id',
        'tipo_contrato_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'rol_id');
    }

    public function grupoSanguineo()
    {
        return $this->belongsTo(Grupo_sanguineo::class, 'tipo_sangre_id');
    }

    public function tipoContrato()
    {
        return $this->belongsTo(Contratos::class, 'tipo_contrato_id');
    }

    public function esInstructor()
    {
        return $this->rol->name === 'instructor';
    }

    public function esAprendiz()
    {
        return $this->rol->name === 'aprendiz';
    }

    public function esAdministrador()
    {
        return $this->rol->name === 'admin';
    }

    public function scopeInstructores($query)
    {
        return $query->whereHas('rol', function($q) {
            $q->where('name', 'instructor');
        });
    }
}