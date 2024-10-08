<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioSIGSA5b extends Model
{
    use HasFactory;

    protected $table = 'formulario_sigsa_base'; // Tabla base

    protected $fillable = [
        'codigo_formulario',     // Código del formulario
        'nombre_paciente',
        'vacuna',
        'codigo_formulario',
        'nombre_paciente',
        'cui',
        'area_salud',
        'distrito_salud',
        'municipio',
        'servicio_salud',
        'responsable_informacion',
        'cargo_responsable',
        'anio',
        'no_orden',
        'sexo',
        'pueblo',
        'fecha_nacimiento',
        'comunidad_linguistica',
        'orientacion_sexual',
        'escolaridad',
        'profesion_oficio',
    ];

    // Relación con la tabla `residencia` (uno a uno)
    public function residencia()
    {
        return $this->hasOne(Residencia::class, 'formulario_base_id');
    }

    // Relación con la tabla `mujer15a49y_otros_grupos` (uno a uno)
    public function mujer15a49yOtrosGrupos()
    {
        return $this->hasOne(Mujer15a49yOtrosGrupos::class, 'formulario_base_id');
    }

    // Relación many-to-many con `TipoFormulario`
    public function tipoFormularios()
    {
        return $this->belongsToMany(TipoFormulario::class, 'formulario_sigsa_tipo_formulario', 'formulario_sigsa_base_id', 'tipo_formulario_id');
    }
}
