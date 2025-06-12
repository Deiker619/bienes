<?php

namespace App\Http\Controllers\RetiroPDF;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\retiro;

class RetiroPDF extends Controller
{
    //

    public function pdf_with_nota($id)
    {
        $retiro = retiro::where('id', $id)
            ->first();
        $dataPDF = ['retiro' => $retiro];
        $pdf = Pdf::loadView('livewire.retiro.pdf.retiros-with-note', $dataPDF)->setPaper('A4', 'landscape'); // 👈 orientación horizontal;
        return $pdf->stream();
    }
}
