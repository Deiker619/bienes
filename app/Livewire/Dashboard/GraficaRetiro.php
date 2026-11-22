<?php

namespace App\Livewire\Dashboard;

use App\Models\Retiro_artificio;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaRetiro extends Component
{
    public function render()
    {
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

        // Obtener el total retirado por cada mes del año actual
        $retirosPorMes = Retiro_artificio::select(
            DB::raw('MONTH(created_at) as mes_num'),
            DB::raw('SUM(cantidad) as total_retirada')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total_retirada', 'mes_num')
            ->toArray();

        // Construir la lista con los 12 meses en español
        $retiros = [];
        foreach ($meses as $num => $nombreMes) {
            $retiros[] = [
                'month' => $nombreMes,
                'total_retirada' => (int) ($retirosPorMes[$num] ?? 0),
            ];
        }

        $data = [
            'retiros' => $retiros,
        ];

        return view('livewire.dashboard.grafica-retiro', compact('data'));
    }
}
