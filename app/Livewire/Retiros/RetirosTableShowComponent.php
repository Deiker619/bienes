<?php

namespace App\Livewire\Retiros;

use App\Models\retiro;
use Livewire\Component;
use App\Services\RetiroService;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class RetirosTableShowComponent extends Component
{
    protected $retiro_service;
    public function boot(RetiroService $retiro_service)
    {
        $this->retiro_service = $retiro_service;
    }


    use WithPagination;
    #[On('renderTableRetiros')]
    public function render()
    {
        $retiros = retiro::query()
            ->with([
                'retiro_artificios' => function ($query) {
                    $query->select('id', 'artificio_id', 'retiro_id', 'cantidad', 'created_at')
                        ->with([
                            'artificio:id,name'
                        ]);
                },
            ])
            ->select('id', 'lugar_destino', 'beneficiario_id', 'jornada_id', 'ente_id', 'created_at')
            ->with([
                'beneficiario:id,nombre',
                'jornada:id,descripcion',
                'coordinacion:id,name_coordinacion',
                'ente:id,descripcion'
            ])

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
