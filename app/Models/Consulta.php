<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consulta';

    protected $fillable = [
        'consulta',
        'control',
        'semana_gestacion',
        'vive',
        'fue',
        'referido_a',
        'diagnostico',
        'codigo_cie',
        'tratamiento_descripcion',
        'tratamiento_presentacion',
        'cantidad_recetada',
        'notificacion_lugar',
        'notificacion_numero',
        'nombre_acompanante',
         // Número de historia clínica
        'formulario_sigsa_base_id'  // Agregar la clave foránea en el modelo
    ];

    // Relación con la tabla formulario_sigsa_base
    public function formularioSIGSA()
    {
        return $this->belongsTo(FormularioSIGSA5b::class, 'formulario_sigsa_base_id');
    }
}
