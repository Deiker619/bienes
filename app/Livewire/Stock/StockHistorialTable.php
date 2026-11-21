<?php
// Archivo que contiene la clase Livewire para mostrar el historial de stock
namespace App\Livewire\Stock;

use App\Models\StockHistorial;
use Livewire\Component;
use Livewire\WithPagination;

class StockHistorialTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filtroFecha = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFiltroFecha()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'filtroFecha']);
        $this->resetPage();
    }

    public function render()
    {
        $query = StockHistorial::with('artificio:id,name');

        if (!empty($this->search)) {
            $searchTerm = '%' . $this->search . '%';
            $query->whereHas('artificio', function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm);
            });
        }

        if (!empty($this->filtroFecha)) {
            $query->whereDate('created_at', $this->filtroFecha);
        }

        $totalAgregado = $query->clone()->sum('cantidad');
        $historial = $query->latest()->paginate(10);

        return view('livewire.stock.stock-historial-table', compact('historial', 'totalAgregado'));
    }
}
