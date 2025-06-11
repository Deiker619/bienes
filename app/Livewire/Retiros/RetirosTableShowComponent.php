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
        $retiros = retiro::select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'beneficiario_id', 'jornada_id', 'ente_id', 'created_at')->orderby('created_at', 'desc')->paginate(10);
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
