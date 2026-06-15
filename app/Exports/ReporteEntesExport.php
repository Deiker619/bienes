<?php

namespace App\Exports;

use App\Models\retiro;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReporteEntesExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;

    protected $type;
    protected $entityId;
    protected $name;

    public function __construct($type, $entityId, $name)
    {
        $this->type = $type;
        $this->entityId = $entityId;
        $this->name = $name;
    }

    public function collection(): Collection
    {
        $query = retiro::with([
            'retiro_artificios.artificio:id,name',
            'beneficiario:id,nombre,cedula',
            'coordinacion:id,name_coordinacion',
            'jornada:id,descripcion',
        ])
        ->whereYear('created_at', date('Y'));

        if ($this->type === 'beneficiario') {
            $query->where('beneficiario_id', $this->entityId);
        } elseif ($this->type === 'coordinacion') {
            $query->where('lugar_destino', $this->entityId);
        } elseif ($this->type === 'jornada') {
            $query->where('jornada_id', $this->entityId);
        }

        // Order by created_at ascending, so older withdrawals are at the top,
        // and newer ones are appended below.
        $retiros = $query->orderBy('created_at', 'asc')->get();

        $rows = collect();

        foreach ($retiros as $retiro) {
            $items = $retiro->retiro_artificios;

            $entityName = '';
            $cedula = '';
            $typeLabel = '';

            if ($this->type === 'beneficiario') {
                $entityName = $retiro->beneficiario?->nombre ?? $this->name;
                $cedula = $retiro->beneficiario?->cedula ?? '';
                $typeLabel = 'Beneficiario';
            } elseif ($this->type === 'coordinacion') {
                $entityName = $retiro->coordinacion?->name_coordinacion ?? $this->name;
                $cedula = '—';
                $typeLabel = 'Coordinación';
            } elseif ($this->type === 'jornada') {
                $entityName = $retiro->jornada?->descripcion ?? $this->name;
                $cedula = '—';
                $typeLabel = 'Jornada';
            }

            if ($items->isEmpty()) {
                $rows->push([
                    $retiro->id,
                    $entityName,
                    $typeLabel,
                    $cedula,
                    '—',
                    '',
                    $retiro->observacion,
                    $retiro->created_at->format('d/m/Y H:i'),
                ]);
                continue;
            }

            foreach ($items as $i => $ra) {
                $rows->push([
                    $i === 0 ? $retiro->id : '',
                    $i === 0 ? $entityName : '',
                    $i === 0 ? $typeLabel : '',
                    $i === 0 ? $cedula : '',
                    $ra->artificio?->name ?? '—',
                    $ra->cantidad,
                    $i === 0 ? $retiro->observacion : '',
                    $i === 0 ? $retiro->created_at->format('d/m/Y H:i') : '',
                ]);
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'ID RETIRO',
            'ENTE / PERSONA',
            'TIPO DE ENTE',
            'CÉDULA',
            'ARTÍCULO',
            'CANTIDAD',
            'OBSERVACIÓN',
            'FECHA RETIRO',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF28A745'], // Green (#28a745)
            ],
        ]);

        $lastRow = $sheet->getHighestRow();

        if ($lastRow > 1) {
            $sheet->getStyle("A1:H{$lastRow}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FFBDC3C7'],
                    ],
                ],
            ]);

            $sheet->getStyle("A2:H{$lastRow}")->applyFromArray([
                'alignment' => [
                    'vertical' => 'center',
                ],
            ]);
        }

        return [];
    }
}
