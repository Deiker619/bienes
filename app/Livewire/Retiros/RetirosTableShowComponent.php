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

    protected $retiro_service;

    public function boot(RetiroService $retiro_service)
    {
        $this->retiro_service = $retiro_service;
    }

    #[On('renderTableRetiros')]
    public function render()
    {
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
            ->latest()
            ->paginate(10);

        return view(
            'livewire.retiros.retiros-table-show-component',
            compact('retiros')
        );
    }

    public function deleteRetiro($id)
    {
        $retiro = $this->retiro_service->deleteRetiro($id);

        if ($retiro) {
            return $this->dispatch('renderTableRetiros');
        }

        return $this->dispatch('error', [
            'message' => 'Error al eliminar el retiro.'
        ]);
    }

    public function exportRetiroWithNote($id)
    {
        $this->retiro_service->exportRetiroWithNote($id);
    }
}
