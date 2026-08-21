<?php

namespace App\Livewire\Dashboard;

use App\Models\Retiro_artificio;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaRetiro extends Component
{
    public $vista = 'mes';
    public $fechaInicio;
    public $fechaFin;
    public $mesFiltro;

    public function mount()
    {
        $this->fechaInicio = $this->fechaInicio ?: now()->startOfWeek()->toDateString();
        $this->fechaFin = $this->fechaFin ?: now()->endOfWeek()->toDateString();
        $this->mesFiltro = $this->mesFiltro ?: '';
    }

    public function render()
    {
        $chart = match ($this->vista) {
            'semana' => $this->chartRetirosPeriodo(),
            'artificio_semana' => $this->chartArtificiosPeriodo(),
            default => $this->chartRetirosMes(),
        };

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

    private function chartRetirosPeriodo(): array
    {
        [$inicio, $fin] = $this->rangoSeguro();

        $totales = Retiro_artificio::select(
            DB::raw('DATE_FORMAT(created_at, "%x-%v") as semana'),
            DB::raw('DATE(created_at) as dia'),
            DB::raw('SUM(cantidad) as total_retirada')
        )
            ->whereBetween('created_at', [$inicio, $fin])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%x-%v")'), DB::raw('DATE(created_at)'))
            ->get();

        if ($inicio->copy()->startOfDay()->diffInDays($fin->copy()->startOfDay()) <= 16) {
            $porDia = $totales->pluck('total_retirada', 'dia');
            $labels = [];
            $valores = [];
            foreach ($inicio->copy()->startOfDay()->daysUntil($fin->copy()->startOfDay()) as $dia) {
                $labels[] = $dia->translatedFormat('d M');
                $valores[] = (int) ($porDia[$dia->toDateString()] ?? 0);
            }
            $titulo = 'Artificios retirados por día';
        } else {
            $porSemana = $totales->groupBy('semana')->map(fn ($filas) => (int) $filas->sum('total_retirada'));
            $labels = [];
            $valores = [];
            $cursor = $inicio->copy()->startOfWeek();
            while ($cursor->lte($fin)) {
                $labels[] = sprintf(
                    'Semana %s (%s - %s)',
                    $cursor->format('W'),
                    $cursor->translatedFormat('d/m'),
                    $cursor->copy()->endOfWeek()->translatedFormat('d/m')
                );
                $valores[] = $porSemana[$cursor->format('o-\WW')] ?? 0;
                $cursor->addWeek();
            }
            $titulo = 'Artificios retirados por semana';
        }

        return ['labels' => $labels, 'data' => $valores, 'titulo' => $titulo];
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

    private function chartArtificiosPeriodo(): array
    {
        [$inicio, $fin] = $this->rangoSeguro();

        return $this->chartArtificios($inicio, $fin, 'Top artificios más retirados en el periodo');
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

    private function rangoSeguro(): array
    {
        try {
            $inicio = Carbon::hasFormat((string) $this->fechaInicio, 'Y-m-d')
                ? Carbon::createFromFormat('Y-m-d', $this->fechaInicio)->startOfDay()
                : now()->startOfWeek();
            $fin = Carbon::hasFormat((string) $this->fechaFin, 'Y-m-d')
                ? Carbon::createFromFormat('Y-m-d', $this->fechaFin)->endOfDay()
                : now()->endOfWeek();
        } catch (\Throwable) {
            $inicio = now()->startOfWeek();
            $fin = now()->endOfWeek();
        }

        if ($inicio->gt($fin)) {
            [$inicio, $fin] = [$fin->copy()->startOfDay(), $inicio->copy()->endOfDay()];
        }

        if ($inicio->copy()->addMonths(6)->lt($fin)) {
            $fin = $inicio->copy()->addMonths(6)->endOfDay();
        }

        return [$inicio, $fin];
    }
}
