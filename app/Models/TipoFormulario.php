<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFormulario extends Model
{
    use HasFactory;

    protected $table = 'tipo_formularios'; // Cambiado a plural para coincidir con la tabla

    protected $fillable = [
        'codigo_formulario',
    ];

    // Relación con FormularioSIGSA5b (Usando una tabla pivote)
    public function formulariosSIGSA()
    {
        // Nombre de la tabla pivote: 'formulario_sigsa_tipo_formulario'
        return $this->belongsToMany(FormularioSIGSA5b::class, 'formulario_sigsa_tipo_formulario');
    }
}
