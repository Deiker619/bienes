<?php

namespace App\Livewire\Retiros;

use App\Models\retiro;
use Livewire\Component;
use App\Services\RetiroService;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class RetirosTableShowComponent extends Component
{
    use WithPagination;

    public $search = '';

    protected $retiro_service;

    public function boot(RetiroService $retiro_service)
    {
        $this->retiro_service = $retiro_service;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('renderTableRetiros')]
    public function render()
    {

  $search= trim($this->search);

    $retiros = retiro::query()
        ->with([
            'retiro_artificios' => function ($query) {
                $query->select('id', 'artificio_id', 'retiro_id', 'cantidad', 'created_at')
                    ->with(['artificio:id,name']);
            },
            'beneficiario:id,nombre',
            'jornada:id,descripcion',
            'coordinacion:id,name_coordinacion',
        ])
        ->when(is_numeric($search), function ($q) use ($search) {
            //  Búsqueda precisa por ID cuando el usuario escribe números
            $q->where('id', $search);
        })
        ->when(preg_match('/^\d{4}-\d{2}-\d{2}$/', $search), function ($q) use ($search) {
            //  Búsqueda precisa por fecha YYYY-MM-DD
            $q->whereDate('created_at', $search);
        })
        ->when(strlen($search) >= 2 && !is_numeric($search) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $search), function ($q) use ($search) {
            // SOLO buscar texto cuando tiene más de 2 caracteres
            $like = "%{$search}%";

            $q->where(function ($q) use ($like) {
                $q->where('observacion', 'LIKE', $like)
                    ->orWhereHas('beneficiario', fn($b) => $b->where('nombre', 'LIKE', $like))
                    ->orWhereHas('jornada', fn($j) => $j->where('descripcion', 'LIKE', $like))
                    ->orWhereHas('coordinacion', fn($c) => $c->where('name_coordinacion', 'LIKE', $like))
                    ->orWhereHas('retiro_artificios.artificio', fn($a) => $a->where('name', 'LIKE', $like));
            });
        })
        ->latest()
        ->paginate(10);

    return view('livewire.retiros.retiros-table-show-component', compact('retiros'));
}

    public function deleteRetiro($id)
    {
        $retiro = $this->retiro_service->deleteRetiro($id);
        if ($retiro) return $this->dispatch('renderTableRetiros');
        return $this->dispatch('error', ['message' => 'Error al eliminar el retiro.']);
    }

    public function exportRetiroWithNote($id)
    {
        $retiro = $this->retiro_service->exportRetiroWithNote($id);
    }
}
