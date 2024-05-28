<?php

namespace App\Livewire\Retiro\Pdf;

use Livewire\Component;
use Barryvdh\DomPDF\PDF;
use App\Models\retiro;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class RetirosExport extends Component
{
    public function render()
    {
        return view('livewire.retiro.pdf.retiros-export');
    }

    public function export(){
        redirect()->route('prueba');
    }
}
