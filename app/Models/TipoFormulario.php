<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFormulario extends Model
{
    use HasFactory;

    protected $table = 'tipo_formulario';

    protected $fillable = [
        'codigo_formulario',
        'descripcion',
    ];

    // Relación con FormularioSIGSA5b
    public function formulariosSIGSA()
    {
        return $this->belongsToMany(FormularioSIGSA5b::class, 'formulario_sigsa_tipo_formulario');
    }
}
