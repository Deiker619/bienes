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
        $search = '%' . $this->search . '%';

        $retiros = retiro::query()
            ->with([
                'retiro_artificios' => function ($query) {
                    $query->select('id', 'artificio_id', 'retiro_id', 'cantidad', 'created_at')
                        ->with([
                            'artificio:id,name'
                        ]);
                },
                'beneficiario:id,nombre',
                'jornada:id,descripcion',
                'coordinacion:id,name_coordinacion',
            ])
            /* Donde se filtra cada dato de la tabla*/
            ->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', $search)
                  ->orWhere('observacion', 'LIKE', $search)
                  ->orWhere('created_at', 'LIKE', $search)

                  ->orWhereHas('beneficiario', fn($b) => $b->where('nombre', 'LIKE', $search))
                  ->orWhereHas('jornada', fn($j) => $j->where('descripcion', 'LIKE', $search))
                  ->orWhereHas('coordinacion', fn($c) => $c->where('name_coordinacion', 'LIKE', $search))
                  ->orWhereHas('retiro_artificios.artificio', fn($a) => $a->where('name', 'LIKE', $search));
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
