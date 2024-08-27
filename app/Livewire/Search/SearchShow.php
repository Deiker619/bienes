<?php

namespace App\Livewire\Search;

use Livewire\Component;
use App\Models\retiro;
use Illuminate\Support\Carbon;


class SearchShow extends Component
{
    public $fecha_inicio, $fecha_fin, $open_modal, $retiros;
    public function render()
    {
        return view('livewire.search.search-show');
    }

    public function search()
    {
        $this->open_modal = true;
        $this->fecha_inicio = Carbon::parse($this->fecha_inicio)->startOfDay();
        $this->fecha_fin = Carbon::parse($this->fecha_fin)->endOfDay();

        if ($this->fecha_fin == $this->fecha_inicio) {
            $this->retiros = retiro::with('artificio:name')->select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'beneficiario_id', 'jornada_id', 'created_at')
                ->whereDate('created_at', $this->fecha_fin)->get();
        } else {


            $this->retiros = retiro::select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'beneficiario_id', 'jornada_id', 'created_at')
                ->whereBetween('created_at', [$this->fecha_inicio, $this->fecha_fin])->get();
        }
    }

    public function close_modal()
    {
        $this->open_modal = false;
        $this->reset(['fecha_inicio', 'fecha_fin', 'retiros']);
    }

    public function export()
    {
        return redirect()->route('prueba', ['fecha_inicio' => $this->fecha_inicio, 'fecha_fin' => $this->fecha_fin]);
    }

    public function exportOnly($id)
    {
        return redirect()->route('exportOnlyRetiro', ['id' => $id]);
    }
}
