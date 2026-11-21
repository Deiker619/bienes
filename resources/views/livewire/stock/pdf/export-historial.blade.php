<div>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }

        .nota-title img {
            width: 116%;
            max-width: none;
            height: auto;
            display: block;
            margin-left: -8%;
            position: relative;
            top: -30px;
        }

        .table-container {
            width: 100%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0 0 10px 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 3px 0;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-weight-bold {
            font-weight: bold;
        }
    </style>

    <div class="nota-title">
        <img src="assets/images/cintillo2.png" alt="">
    </div>

    <div class="header">
        <h1>Reporte de Historial de Stock</h1>
        @if(isset($subtitulo) && $subtitulo)
            <p><strong>Detalle:</strong> {{ $subtitulo }}</p>
        @endif
        <p><strong>Fecha de emisión:</strong> {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;" class="text-center">ID</th>
                    <th>Nombre del Artificio</th>
                    <th style="width: 140px;" class="text-center">Cantidad Agregada</th>
                    <th style="width: 140px;" class="text-center">Fecha y Hora</th>
                </tr>
            </thead>
            <tbody>
                @php $sumaTotal = 0; @endphp
                @forelse ($historial as $item)
                    @php
                        $sumaTotal += (int) $item->cantidad;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td>{{ $item->artificio?->name ?? 'N/A' }}</td>
                        <td class="text-center font-weight-bold">{{ $item->cantidad }}</td>
                        <td class="text-center">{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron registros.</td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($historial) > 0)
                <tfoot>
                    <tr style="background-color: #e9ecef;">
                        <td colspan="2" class="text-right font-weight-bold">
                            Total de Artificios Agregados:
                        </td>
                        <td colspan="2" class="text-center font-weight-bold" style="font-size: 13px;">
                            {{ $sumaTotal }}
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>
