<?php

namespace App\Livewire\Stock;

use App\Models\artificio;
use App\Models\stock;
use Livewire\Component;
use Livewire\Attributes\On;


class StockLayoutsShow extends Component
{
    protected $listeners = ['artificioAdded' => 'artificioAdded'];
    public $cantidad_artificio, $artificio, $open_edit, $id;
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

        if($total<=0){
            $porcentajes = 0;
        }else{
            foreach($stocks as $s){
                $result = (($s->cantidad_artificio / $total) *100);
                
                array_push($porcentajes, $result);
            }
        }
        



        return $porcentajes;
    }

    public function edit($id)
    {
        $this->open_edit = true;
        $registro = stock::findOrfail($id);
        
        $this->cantidad_artificio = $registro->cantidad_artificio;
        $this->id = $registro->id;
        
    }

    public function update()
    {
        
        $registro = stock::find($this->id);
        $registro->fill($this->all());
        $registro->save();


        $this->open_edit = false;
        $this->dispatch('artificioAdded', 'Se modificó este stock');
    }

    public function delete($id)
    {
        
        $registro = stock::findOrFail($id);
        $registro->delete();

        $this->dispatch('artificioAdded', 'Artificio eliminado del stock');
       
    }

    public function export(){
        return redirect()->route('prueba');
    }
}
