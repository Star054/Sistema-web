<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioSIGSA5b extends Model
{
    use HasFactory;

    protected $table = 'formulario_sigsa_base';

    protected $fillable = [

        'vacuna',
        'area_salud',
        'distrito_salud',
        'municipio',
        'servicio_salud',
        'responsable_informacion',
        'cargo_responsable',
        'anio',
        // Campos del paciente
        'no_orden',
        'cui',
        'nombre_paciente',
        'sexo',
        'pueblo',
        'fecha_nacimiento',
        'comunidad_linguistica',
        'escolaridad',
        'profesion_oficio',

    ];

    // Relación con el modelo Residencia (uno a uno)
    public function residencia()
    {
        return $this->hasOne(Residencia::class, 'formulario_base_id');
    }

    // Relación con el modelo Mujer15a49yOtrosGrupos (uno a uno)
    public function mujer15a49yOtrosGrupos()
    {
        return $this->hasOne(Mujer15a49yOtrosGrupos::class, 'formulario_base_id');
    }

    // Relación many-to-many con el modelo TipoFormulario
    public function tiposFormulario()
    {
        return $this->belongsToMany(TipoFormulario::class, 'formulario_sigsa_tipo_formulario', 'formulario_sigsa_base_id', 'tipo_formulario_id');
    }



}


