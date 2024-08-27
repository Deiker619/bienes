<?php

namespace App\Livewire\Dashboard;

use App\Models\retiro;
use App\Models\stock;
use Livewire\Component;
use Carbon\Carbon;



class CardGrafica extends Component
{
    public function render()
    {


        $today = Carbon::today();
        // Obtén la fecha de ayer
        $yesterday = $today->copy()->subDay();
        // Obtén la fecha de hace dos días
        $dayBeforeYesterday = $today->copy()->subDays(2);
        // Consulta para registros de hoy
        $actual = retiro::select('created_at')
            ->whereDate('created_at', $today->toDateString())
            ->get();
        // Consulta para registros de ayer
        $ayer = retiro::select('created_at')
            ->whereDate('created_at', $yesterday->toDateString())
            ->get();

        // Consulta para registros de hace dos días
        $antesAyer = retiro::select('created_at')
            ->whereDate('created_at', $dayBeforeYesterday->toDateString())
            ->get();

        $data = array([
            'actual' => $actual,
            'ayer' => $ayer,
            'antesAyer' => $antesAyer
        ]);
        $total_artificio = stock::sum('cantidad_artificio');
        return view('livewire.dashboard.card-grafica', compact('actual', 'ayer', 'antesAyer', 'data', 'total_artificio'));
    }
}
