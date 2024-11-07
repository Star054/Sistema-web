<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacunasAdministradas extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacuna_id',
        'fecha_administracion',
        'dosis',
        'formulario_sigsa_base_id',
    ];

    public function vacuna()
    {
        return $this->belongsTo(Vacuna::class); // Asegúrate de que 'Vacuna' sea el modelo correcto
    }

    public function formulario()
    {
        return $this->belongsTo(Modelo5bA::class, 'formulario_sigsa_base_id');
    }
}
