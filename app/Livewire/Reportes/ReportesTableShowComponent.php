<?php

namespace App\Livewire\Reportes;

use App\Exports\ReporteEntesExport;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ReportesTableShowComponent extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $beneficiariosQuery = DB::table('retiros')
            ->join('beneficiarios', 'retiros.beneficiario_id', '=', 'beneficiarios.id')
            ->select([
                DB::raw("'beneficiario' as type"),
                'beneficiarios.id as entity_id',
                'beneficiarios.nombre as name',
                'beneficiarios.cedula as cedula',
                DB::raw('MAX(retiros.created_at) as ultimo_retiro')
            ])
            ->groupBy('beneficiarios.id', 'beneficiarios.nombre', 'beneficiarios.cedula');

        $coordinacionesQuery = DB::table('retiros')
            ->join('coordinacions', 'retiros.lugar_destino', '=', 'coordinacions.id')
            ->select([
                DB::raw("'coordinacion' as type"),
                'coordinacions.id as entity_id',
                'coordinacions.name_coordinacion as name',
                DB::raw('NULL as cedula'),
                DB::raw('MAX(retiros.created_at) as ultimo_retiro')
            ])
            ->groupBy('coordinacions.id', 'coordinacions.name_coordinacion');

        $jornadasQuery = DB::table('retiros')
            ->join('jornadas', 'retiros.jornada_id', '=', 'jornadas.id')
            ->select([
                DB::raw("'jornada' as type"),
                'jornadas.id as entity_id',
                'jornadas.descripcion as name',
                DB::raw('NULL as cedula'),
                DB::raw('MAX(retiros.created_at) as ultimo_retiro')
            ])
            ->groupBy('jornadas.id', 'jornadas.descripcion');

        $unionQuery = $beneficiariosQuery
            ->unionAll($coordinacionesQuery)
            ->unionAll($jornadasQuery);

        $query = DB::table(DB::raw("({$unionQuery->toSql()}) as temp"))
            ->mergeBindings($unionQuery);

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('cedula', 'like', '%' . $this->search . '%')
                  ->orWhere('type', 'like', '%' . $this->search . '%');
            });
        }

        // Order by most recent to oldest
        $results = $query->orderBy('ultimo_retiro', 'desc')
            ->paginate(10);

        return view('livewire.reportes.reportes-table-show-component', compact('results'));
    }

    public function exportarExcel($type, $entityId, $name)
    {
        $nombreSanitizado = preg_replace('/[^a-zA-Z0-9_]/', '_', $name);
        $nombreArchivo = 'reporte_' . $type . '_' . $nombreSanitizado . '.xlsx';

        return (new ReporteEntesExport($type, $entityId, $name))->download($nombreArchivo);
    }
}
