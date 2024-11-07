<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacuna;

class InventarioController extends Controller
{
    public function reducirDosisPorNombre($nombreVacuna)
    {
        $vacuna = Vacuna::where('nombre_vacuna', $nombreVacuna)->firstOrFail();

        // Verificar y ajustar el inventario
        if ($vacuna->cantidad_despachada < 1) {
            return false; // Stock insuficiente para monodosis
        }
        $vacuna->cantidad_despachada -= 1;

        $vacuna->save();
        return true; // Reducción exitosa
    }

    public function reducirDosis($vacunaId)
    {
        $vacuna = Vacuna::findOrFail($vacunaId);

        // Verificar y ajustar el inventario
        if ($vacuna->cantidad_despachada < 1) {
            return false; // Stock insuficiente para monodosis
        }
        $vacuna->cantidad_despachada -= 1;

        $vacuna->save();
        return true; // Reducción exitosa
    }

    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->get('search', '');

        // Filtrar las vacunas según el término de búsqueda
        $vacunas = Vacuna::when($search, function ($query, $search) {
            return $query->where('nombre_vacuna', 'like', '%' . $search . '%');
        })->get();

        // Calcular totales de vacunas
        $totalVacunas = Vacuna::sum('cantidad_despachada');
        $totalUtilizadas = Vacuna::sum('cantidad_solicitada');

        return view('vacunas.inventario.index', compact('vacunas', 'totalVacunas', 'totalUtilizadas', 'search'));
    }

    public function actualizarInventario(Request $request)
    {
        // Encontrar la vacuna por ID
        $vacuna = Vacuna::findOrFail($request->vacuna_id);

        // Validar disponibilidad de stock
        if ($vacuna->cantidad_despachada <= 0) {
            return response()->json(['error' => 'No hay stock disponible para esta vacuna.'], 400);
        }

        // Disminuir la cantidad para monodosis
        $vacuna->cantidad_despachada -= 1;

        // Guardar cambios
        $vacuna->save();

        // Retornar la cantidad actualizada y los totales
        $totalVacunas = Vacuna::sum('cantidad_despachada');
        $totalUtilizadas = Vacuna::sum('cantidad_solicitada');

        return response()->json([
            'cantidad_despachada' => $vacuna->cantidad_despachada,
            'total_vacunas' => $totalVacunas,
            'total_utilizadas' => $totalUtilizadas,
        ]);
    }
}
