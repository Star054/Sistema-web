<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacunaInventario extends Model
{
use HasFactory;

// Especifica el nombre de la tabla
protected $table = 'vacunas_inventario';

protected $fillable = [
'vacuna_id',
'nombre_vacuna',
// 'tipo_dosis', // Comenta o elimina si no lo usas
'cantidad_disponible', // Cambia 'cantidad_despachada' por 'cantidad_disponible' para que coincida con la base de datos
];

public function vacuna()
{
return $this->belongsTo(Vacuna::class);
}
}
