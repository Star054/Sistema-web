<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioSIGSA5b extends Model
{
    use HasFactory;

    protected $table = 'formulario_sigsa_5b';

    protected $fillable = [
        'vacuna',
        'area_salud',
        'distrito_salud',
        'municipio',
        'servicio_salud',
        'responsable_informacion',
        'cargo_responsable',
        'anio',
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

    // Relación con el modelo Residencia
    public function residencia()
    {
        return $this->hasOne(Residencia::class, 'formulario_sigsa_5b_id');
    }

    // Relación con el modelo Mujer15a49yOtrosGrupos
    public function mujer15a49yOtrosGrupos()
    {
        return $this->hasOne(Mujer15a49yOtrosGrupos::class, 'formulario_sigsa_5b_id');
    }
}
