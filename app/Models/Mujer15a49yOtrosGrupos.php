<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mujer15a49yOtrosGrupos extends Model
{
    use HasFactory;

    protected $table = 'mujer15a49y_otros_grupos';

    // Lista de campos que se pueden asignar de manera masiva
    protected $fillable = [
        'formulario_sigsa_5b_id',  // Relación con el formulario
        'vacuna_mujer_15_49_1a',
        'vacuna_mujer_15_49_2a',
        'vacuna_mujer_15_49_3a',
        'vacuna_mujer_15_49_r1',
        'vacuna_mujer_15_49_r2',
        'vacuna_otros_grupos_1a',
        'vacuna_otros_grupos_2a',
        'vacuna_otros_grupos_3a',
        'vacuna_otros_grupos_r1',
        'vacuna_otros_grupos_r2',
    ];

    // Relación con el modelo FormularioSIGSA5b
    public function formularioSIGSA5b()
    {
        return $this->belongsTo(FormularioSIGSA5b::class, 'formulario_sigsa_5b_id');
    }
}
