<?php

namespace App\Livewire\Dashboard;

use App\Models\Retiro_artificio;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaRetiro extends Component
{
    public $mesFiltro;

    public function mount()
    {
        $this->mesFiltro = $this->mesFiltro ?: '';
    }

    public function render()
    {
        $chart = $this->chartRetirosMes();
        $chart['vacio'] = count($chart['data']) === 0;

        return view('livewire.dashboard.grafica-retiro', compact('chart'));
    }

    private function chartRetirosMes(): array
    {
        if ($this->mesFiltroValido()) {
            return $this->chartArtificiosMes();
        }

        $datos = Retiro_artificio::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('SUM(cantidad) as total_retirada')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->pluck('total_retirada', 'mes');

        $labels = [];
        $valores = [];
        foreach (range(1, 12) as $mes) {
            $labels[] = Carbon::create(now()->year, $mes, 1)->translatedFormat('F');
            $valores[] = (int) ($datos[$mes] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $valores,
            'titulo' => 'Cantidad de artificios retirados por mes',
        ];
    }

    private function mesFiltroValido(): bool
    {
        return !empty($this->mesFiltro) && Carbon::hasFormat((string) $this->mesFiltro, 'Y-m');
    }

    private function chartArtificiosMes(): array
    {
        try {
            $mes = Carbon::createFromFormat('Y-m', $this->mesFiltro)->startOfDay();
        } catch (\Throwable) {
            $mes = now()->startOfDay();
        }

        return $this->chartArtificios(
            $mes->copy()->startOfMonth(),
            $mes->copy()->endOfMonth()->endOfDay(),
            'Top artificios más retirados en ' . $mes->translatedFormat('F Y')
        );
    }

    private function chartArtificios($inicio, $fin, string $titulo): array
    {
        $datos = Retiro_artificio::join('artificios', 'artificios.id', '=', 'retiro_artificios.artificio_id')
            ->select('artificios.name as name', DB::raw('SUM(retiro_artificios.cantidad) as total_retirada'))
            ->whereBetween('retiro_artificios.created_at', [$inicio, $fin])
            ->groupBy('artificios.name')
            ->orderByDesc('total_retirada')
            ->limit(10)
            ->get();

        return [
            'labels' => $datos->pluck('name')->toArray(),
            'data' => $datos->pluck('total_retirada')->map(fn ($v) => (int) $v)->toArray(),
            'titulo' => $titulo,
        ];
    }
}
