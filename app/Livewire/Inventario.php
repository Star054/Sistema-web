<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vacuna;

class Inventario extends Component
{
    public $search = '';
    public $vacunas;
    public $totalVacunas;
    public $totalUtilizadas;

    protected $listeners = ['actualizarInventario' => 'decrementarInventario'];

    public function mount()
    {
        $this->vacunas = Vacuna::all();
        $this->actualizarTotales();
    }

    public function updatedSearch()
    {
        $this->vacunas = Vacuna::where('nombre_vacuna', 'like', '%' . $this->search . '%')->get();
    }

    public function decrementarInventario($vacunaId, $tipoDosis)
    {
        $vacuna = Vacuna::findOrFail($vacunaId);

        if ($tipoDosis == 'monodosis') {
            $vacuna->cantidad_despachada -= 1;
        } elseif ($tipoDosis == 'multidosis') {
            $vacuna->cantidad_despachada -= 0.1;
        }

        $vacuna->save();
        $this->actualizarTotales();
        $this->vacunas = Vacuna::all();
    }

    private function actualizarTotales()
    {
        $this->totalVacunas = Vacuna::sum('cantidad_despachada');
        $this->totalUtilizadas = Vacuna::sum('cantidad_solicitada');
    }

    public function render()
    {
        return view('livewire.inventario.index'); // Verifica que esta vista exista
    }
}
