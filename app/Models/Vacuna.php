<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
    use HasFactory;

    // Campos que son asignables en masa
    protected $fillable = [
        'nombre_vacuna',
        'descripcion',
        'cantidad_solicitada',
        'cantidad_autorizada',
        'cantidad_despachada', // Este campo es clave para la gestión del stock
        'fecha_ingreso',
        'hora_recepcion',
        'fecha_recepcion',
    ];

    // Puedes agregar relaciones si las necesitas, por ejemplo:
    public function vacunasAdministradas()
    {
        return $this->hasMany(VacunaAdministrada::class);
    }

    public function vacunasInventario()
    {
        return $this->hasMany(VacunaInventario::class);
    }
}
