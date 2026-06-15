<?php

namespace App\Livewire\Retiros;

use App\Models\retiro;
use Livewire\Component;
use App\Services\RetiroService;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class RetirosTableShowComponent extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public $search = '';

    protected $retiro_service;

    public function boot(RetiroService $retiro_service)
    {
        $this->retiro_service = $retiro_service;
    }

    public function updatedSearch()
    {
        $this->resetPage();
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
                'beneficiario:id,nombre,cedula',
                'jornada:id,descripcion',
                'coordinacion:id,name_coordinacion',
            ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('beneficiario', function ($q) {
                        $q->where('nombre', 'like', '%' . $this->search . '%')
                          ->orWhere('cedula', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereRaw("DATE_FORMAT(created_at, '%d/%m/%Y') LIKE ?", ['%' . $this->search . '%'])
                    ->orWhere('id', $this->search)
                    ->orWhereHas('coordinacion', function ($q) {
                        $q->where('name_coordinacion', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('jornada', function ($q) {
                        $q->where('descripcion', 'like', '%' . $this->search . '%');
                    });
                });
            })
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
