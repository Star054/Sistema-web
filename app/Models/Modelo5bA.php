<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo5bA extends Model
{
    use HasFactory;

    // Definir la tabla asociada a este modelo
    protected $table = 'formulario_sigsa_base'; // Tabla base

    // Definir los campos rellenables (fillable)
    protected $fillable = [
        'nombre_paciente',
        'cui',
        // Otros campos del formulario base
    ];

    // Relación con la tabla `criterios_vacuna`
    public function criteriosVacuna()
    {
        return $this->hasMany(CriteriosVacuna::class, 'formulario_sigsa_base_id');
    }

    // Relación con la tabla `residencia`
    public function residencia()
    {
        return $this->hasOne(Residencia::class, 'formulario_sigsa_base_id');
    }

    // Relación many-to-many con `tipo_formularios`
    public function tipoFormularios()
    {
        return $this->belongsToMany(TipoFormulario::class, 'formulario_sigsa_tipo_formulario', 'formulario_sigsa_base_id', 'tipo_formulario_id');
    }

}
