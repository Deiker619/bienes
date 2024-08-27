<?php

namespace App\Http\Controllers;

use App\Models\beneficiario;
use App\Models\retiro;
use App\Models\stock;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class PDFController extends Controller
{
    public function generatePDF($fecha_inicio, $fecha_fin)
    {
        /* $users = User::get(); */

        $fecha_inicio = Carbon::parse($fecha_inicio)->startOfDay();
        $fecha_fin = Carbon::parse($fecha_fin)->endOfDay();


        
        if($fecha_fin == $fecha_inicio){
            $retiros = retiro::with('artificio:name')->select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'beneficiario_id','jornada_id', 'created_at')
            ->whereDate('created_at', $fecha_fin)->get();
        }else{

            $retiros = retiro::select('id', 'artificio_id', 'cantidad_retirada',  'lugar_destino', 'beneficiario_id','jornada_id', 'created_at')
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])->get();
        }

        $data = [
            'title' => 'Welcome to Funda of Web IT - fundaofwebit.com',
            'date' => date('m/d/Y'),
            'retiros' => $retiros
        ];

        $pdf = Pdf::loadView('prueba', $data);
        return $pdf->download(date('d-m-Y').'.pdf');
    }

    public function generateOnlyRetiro($id){
        $retiros = retiro::select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'beneficiario_id','jornada_id', 'created_at')
        ->where('id', $id)
        ->first();
        $data = [
            'title' => 'Welcome to Funda of Web IT - fundaofwebit.com',
            'date' => date('m/d/Y'),
            'retiros' => $retiros
        ];
        $pdf = Pdf::loadView('exportOnlyRetiro', $data);
        return $pdf->download(date('d-m-Y').'.pdf');


    }

    public function exportStock(){
        $stock = stock::select('id', 'artificio_id', 'cantidad_artificio', 'created_at')
        ->get();
        $data = [
            'title' => 'Welcome to Funda of Web IT - fundaofwebit.com',
            'date' => date('m/d/Y'),
            'stock' => $stock
        ];
        $pdf = Pdf::loadView('livewire.stock.pdf.export-stock', $data);
        return $pdf->download(date('d-m-Y').'.pdf');
    }

    public function exportAllRetiros(){
        $retiros = retiro::select('id', 'artificio_id', 'cantidad_retirada','lugar_destino','beneficiario_id','jornada_id', 'created_at')
        ->get();
        
        $data = [
            'title' => 'Welcome to Funda of Web IT - fundaofwebit.com',
            'date' => date('m/d/Y'),
            'retiros' => $retiros
        ];
        $pdf = Pdf::loadView('livewire.retiros.pdf.retiros-all', $data);
        return $pdf->download(date('d-m-Y').'.pdf');
    }
}