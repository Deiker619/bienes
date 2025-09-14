<?php

namespace App\Http\Controllers\RetiroPDF;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\retiro;
use App\Services\DataRetiroService;

class RetiroPDF extends Controller
{
    //
    protected $DataRetiroService;
    public function __construct(DataRetiroService $DataRetiroService)
    {
        $this->DataRetiroService = $DataRetiroService;
    }
    public function pdf_with_nota($id)
    {
        $retiro = $this->DataRetiroService->DataPdfWithNota($id);

        
        $dataPDF = ['retiro' => $retiro];
        //dd($dataPDF);
        $pdf = Pdf::loadView('livewire.retiro.pdf.retiros-with-note', $dataPDF)->setPaper('A4', 'landscape'); // 👈 orientación horizontal;
        return $pdf->stream();
    }
}
