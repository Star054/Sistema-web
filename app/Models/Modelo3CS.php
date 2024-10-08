<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo3CS extends Model
{
    use HasFactory;

    protected $table = 'formulario_sigsa_base'; // Si esta tabla es la correcta

    protected $fillable = [
        'nombre_paciente',
        'cui',
        'sexo',
        'dia_consulta',
        'no_historia_clinica',
        'area_salud',
        'distrito_salud',
        'municipio',
        'servicio_salud',
        'responsable_informacion',
        'cargo_responsable',
        'anio',
        'no_orden',
        'pueblo',
        'fecha_nacimiento',
        'comunidad_linguistica',
        'orientacion_sexual',
        'escolaridad',
        'profesion_oficio',

        'consulta',
        'control',
        'semana_gestacion',
        'referido_a',
        'diagnostico',
        'codigo_cie',
        'tratamiento_descripcion',
        'tratamiento_presentacion',
        'cantidad_recetada',
        'notificacion_lugar',
        'notificacion_numero',
        'nombre_acompanante',

    ];

    // Relación con Residencia
    public function residencia()
    {
        return $this->hasOne(Residencia::class, 'formulario_base_id');
    }

    // Relación con Consulta
    public function consulta()
    {
        return $this->hasOne(Consulta::class, 'formulario_sigsa_base_id');
    }

    // Relación many-to-many con TipoFormulario
    public function tiposFormulario()
    {
        return $this->belongsToMany(TipoFormulario::class, 'formulario_sigsa_tipo_formulario', 'formulario_sigsa_base_id', 'tipo_formulario_id');
    }

}
