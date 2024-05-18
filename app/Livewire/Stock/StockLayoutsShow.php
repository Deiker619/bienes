<?php

namespace App\Livewire\Stock;

use App\Models\artificio;
use App\Models\stock;
use Livewire\Component;
use Livewire\Attributes\On;


class StockLayoutsShow extends Component
{
    protected $listeners = ['artificioAdded' => 'artificioAdded'];
    public $cantidad_artificio, $artificio, $open_edit;
    #[On('artificioAdded')]
    public function render()
    {
        $stocks = stock::with('artificio:id,name')
            ->select('id', 'cantidad_artificio','created_at' ,'updated_at',  'artificio_id')
            ->orderBy('cantidad_artificio', 'desc')
            ->get();
        $suma = stock::sum('cantidad_artificio');
        $total = $this->calculoPorcentaje();

        return view('livewire.stock.stock-layouts-show', compact('stocks', 'total', 'suma'));
    }

    public function calculoPorcentaje(){
        $stocks = stock:: select('id', 'cantidad_artificio')->orderBy('cantidad_artificio', 'desc')->get();
        $total = stock::sum('cantidad_artificio');
        $porcentajes = array();

        foreach($stocks as $s){
            $result = ($s->cantidad_artificio / $total) *100;
            array_push($porcentajes, $result);
        }

        return $porcentajes;
    }

    public function edit($id)
    {
        $this->open_edit = true;
        $registro = stock::findOrfail($id);
        
        $this->cantidad_artificio = $registro->cantidad_artificio;
        
    }
}
