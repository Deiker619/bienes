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

class RetirosPersonaExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;
    protected $beneficiarioId;
    protected $nombreBeneficiario;

    public function __construct($beneficiarioId, $nombreBeneficiario)
    {
        $this->beneficiarioId = $beneficiarioId;
        $this->nombreBeneficiario = $nombreBeneficiario;
    }

    public function collection(): Collection
    {
        $retiros = retiro::with([
            'retiro_artificios.artificio:id,name',
            'beneficiario:id,nombre,cedula',
        ])
            ->where('beneficiario_id', $this->beneficiarioId)
            ->latest()
            ->get();

        $rows = collect();

        foreach ($retiros as $retiro) {
            $items = $retiro->retiro_artificios;

            if ($items->isEmpty()) {
                $rows->push([
                    $retiro->id,
                    $retiro->beneficiario?->nombre ?? 'N/A',
                    $retiro->beneficiario?->cedula ?? 'N/A',
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
                    $i === 0 ? $retiro->beneficiario->nombre : '',
                    $i === 0 ? $retiro->beneficiario->cedula : '',
                    $ra->artificio->name,
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
            'PERSONA',
            'CÉDULA',
            'ARTÍCULO',
            'CANTIDAD',
            'OBSERVACIÓN',
            'FECHA',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF2C3E50'],
            ],
        ]);

        $lastRow = $sheet->getHighestRow();

        if ($lastRow > 1) {
            $sheet->getStyle("A1:G{$lastRow}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FFBDC3C7'],
                    ],
                ],
            ]);

            $sheet->getStyle("A2:G{$lastRow}")->applyFromArray([
                'alignment' => [
                    'vertical' => 'center',
                ],
            ]);
        }

        return [];
    }
}
