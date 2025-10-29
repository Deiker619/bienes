<?php

namespace App\Livewire\Retiro;

use App\Models\retiro;
use App\Models\Retiro_artificio;
use Livewire\Attributes\On;
use Livewire\Component;

class RetiroHistorial extends Component
{

    protected $listeners = ['artificioAdded' => 'artificioAdded'];

    #[On('artificioAdded')]
    public function render()
    {
        $retiros = retiro::query()
            ->with([
                'retiro_artificios' => function ($query) {
                    $query->select('id', 'artificio_id', 'retiro_id', 'cantidad', 'created_at')
                        ->with([
                            'artificio:id,name'
                        ]);
                },
            ])
            ->select('id', 'lugar_destino', 'beneficiario_id', 'jornada_id', 'ente_id', 'created_at')
            ->with([
                'beneficiario:id,nombre',
                'jornada:id,descripcion',
                'coordinacion:id,name_coordinacion',
                'ente:id,descripcion'
            ])

            ->latest()
            ->limit(3)
            ->get();

        //dd($retiros);



        return view('livewire.retiro.retiro-historial', compact('retiros'));
    }
}
