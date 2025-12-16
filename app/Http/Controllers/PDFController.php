<?php

namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Services\RetiroService;

class PDFController extends Controller
{
    protected $retiroService;

    public function __construct(RetiroService $retiroService)
    {
        $this->retiroService = $retiroService;
    }

    /**
     * Generar PDF de retiros entre fechas
     */
    public function generatePDF($fecha_inicio, $fecha_fin)
    {
        $fecha_inicio = Carbon::parse($fecha_inicio)->startOfDay();
        $fecha_fin = Carbon::parse($fecha_fin)->endOfDay();

        $resultado = $this->retiroService->obtenerRetirosConTotal($fecha_inicio, $fecha_fin);

        $data = [
            'title' => 'Reporte de Retiros',
            'date' => date('d/m/Y'),
            'retiros' => $resultado['retiros'],
            'totalArtificios' => $resultado['totalArtificios']
        ];

        $pdf = Pdf::loadView('prueba', $data);

        return $pdf->download(date('d-m-Y') . '.pdf');
    }

    /**
     * Generar PDF de un retiro específico (compatible con Blade antiguo)
     */
public function generateOnlyRetiro($id)
{
    // Obtener retiro único
    $retiros = \App\Models\retiro::with(['retiro_artificios.artificio'])
        ->where('id', $id)
        ->first();

    if (!$retiros) {
        abort(404, 'Retiro no encontrado');
    }

    // Total de artificios de este retiro
    $totalArtificios = $retiros->retiro_artificios->sum('cantidad');

    $data = [
        'title' => 'Reporte de Retiro',
        'date' => date('d/m/Y'),
        'retiros' => $retiros,       // se mantiene igual que antes
        'totalArtificios' => $totalArtificios
    ];

    $pdf = Pdf::loadView('exportOnlyRetiro', $data);
    return $pdf->download(date('d-m-Y') . '.pdf');
}

    /**
     * Exportar stock
     */
    public function exportStock()
    {
        $stock = stock::select('id', 'artificio_id', 'cantidad_artificio', 'created_at')->get();

        $data = [
            'title' => 'Reporte de Stock',
            'date' => date('d/m/Y'),
            'stock' => $stock
        ];

        $pdf = Pdf::loadView('livewire.stock.pdf.export-stock', $data);
        return $pdf->download(date('d-m-Y') . '.pdf');
    }

    /**
     * Exportar todos los retiros
     */
    public function exportAllRetiros()
    {
        $resultado = $this->retiroService->obtenerRetirosConTotal();

        $data = [
            'title' => 'Reporte Completo de Retiros',
            'date' => date('d/m/Y'),
            'retiros' => $resultado['retiros'],
            'totalArtificios' => $resultado['totalArtificios']
        ];

        $pdf = Pdf::loadView('livewire.retiros.pdf.retiros-all', $data);

        $pdf->stream();
        return $pdf->download(date('d-m-Y') . '.pdf');
    }
}
