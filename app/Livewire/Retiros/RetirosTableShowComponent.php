<?php

namespace App\Livewire\Retiros;

use App\Exports\RetirosPersonaExport;
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

        $beneficiarioBusqueda = null;
        if (!empty($this->search)) {
            $beneficiarioBusqueda = \App\Models\beneficiario::where('cedula', trim($this->search))->first();
        }
        $isExcelEnabled = !empty($beneficiarioBusqueda);

        return view(
            'livewire.retiros.retiros-table-show-component',
            compact('retiros', 'isExcelEnabled')
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

    public function exportarExcelPersona($retiroId)
    {
        $retiro = retiro::with('beneficiario')->findOrFail($retiroId);

        if (!$retiro->beneficiario) {
            $this->dispatch('error', 'Esta opción solo está disponible para retiros de beneficiarios.');
            return;
        }

        $nombreArchivo = 'retiros_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $retiro->beneficiario->nombre) . '.xlsx';

        return (new RetirosPersonaExport(
            $retiro->beneficiario_id,
            $retiro->beneficiario->nombre
        ))->download($nombreArchivo);
    }

    public function exportarExcelBusqueda()
    {
        $beneficiario = \App\Models\beneficiario::where('cedula', trim($this->search))->first();

        if (!$beneficiario) {
            $this->dispatch('error', 'No se encontró ningún beneficiario con esa cédula.');
            return;
        }

        $nombreArchivo = 'retiros_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $beneficiario->nombre) . '.xlsx';

        return (new RetirosPersonaExport(
            $beneficiario->id,
            $beneficiario->nombre
        ))->download($nombreArchivo);
    }
}
