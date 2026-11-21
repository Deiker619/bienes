<?php

namespace App\Livewire\Stock;

use App\Models\Artificio;
use App\Models\stock;
use App\Models\StockHistorial;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class StockLayoutsShow extends Component
{
    use WithPagination;
    protected $listeners = ['artificioAdded' => 'artificioAdded'];
    public $cantidad_artificio, $artificio, $open_edit, $id;
    #[On('artificioAdded')]
    public function render()
    {
        $stocks = stock::with('artificio:id,name')
            ->select('id', 'cantidad_artificio','created_at' ,'updated_at',  'artificio_id')
            ->orderBy('cantidad_artificio', 'desc')
            ->paginate(10);
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
        $cantidadAnterior = $registro->cantidad_artificio;
        $cantidadNueva = $this->cantidad_artificio;
        $diferencia = $cantidadNueva - $cantidadAnterior;

        $registro->fill($this->all());
        $registro->save();

        /* Si aumentó la cantidad, registrar la adición en el historial */
        if ($diferencia > 0) {
            $historialHoy = StockHistorial::where('artificio_id', $registro->artificio_id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($historialHoy) {
                $historialHoy->cantidad = $historialHoy->cantidad + $diferencia;
                $historialHoy->save();
            } else {
                StockHistorial::create([
                    'artificio_id' => $registro->artificio_id,
                    'cantidad' => $diferencia,
                ]);
            }
        } elseif ($diferencia < 0) {
            /* Si se descontó la cantidad al editar, descontar también del historial */
            $historial = StockHistorial::where('artificio_id', $registro->artificio_id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            // Si no hay registro de hoy, buscar el más reciente de ese artificio
            if (!$historial) {
                $historial = StockHistorial::where('artificio_id', $registro->artificio_id)
                    ->latest()
                    ->first();
            }

            if ($historial) {
                $nuevaCantidad = $historial->cantidad + $diferencia; // diferencia es un número negativo
                if ($nuevaCantidad > 0) {
                    $historial->cantidad = $nuevaCantidad;
                    $historial->save();
                } else {
                    $historial->delete();
                }
            }
        }

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
