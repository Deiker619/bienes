<?php

namespace App\Livewire\Dashboard;

use App\Models\retiro;
use App\Models\Retiro_artificio;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaRetiro extends Component
{
    public function render()
    {


        // Selecciona el año y el mes, y suma la cantidad retirada en cada mes

        /* $prueba = retiro::select('created_at', 'cantidad_retirada')
        ->whereYear('created_at', date('Y'))
        ->groupBy('created_at', 'cantidad_retirada')->get(); */

        $datos = Retiro_artificio::select(
            DB::raw('DATE_FORMAT(created_at, "%M") as month'),
            DB::raw('SUM(cantidad) as total_retirada')
        )->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%M")'))
            ->get();

       

        $data = [
            'retiros' => $datos,

        ];

        return view('livewire.dashboard.grafica-retiro', compact('data'));
    }
}
