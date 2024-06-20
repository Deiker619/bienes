<?php

namespace App\Http\Controllers;

use App\Models\retiro;
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
            $retiros = retiro::with('artificio:name')->select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'created_at')
            ->whereDate('created_at', $fecha_fin)->get();
        }else{

            $retiros = retiro::select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'created_at')
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
        $retiros = retiro::select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'created_at')
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
}