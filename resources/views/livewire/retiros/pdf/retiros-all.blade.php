<div>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
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
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
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
            margin: 0;
        }
    </style>

    <h1>Reporte de Retiro</h1>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Retiro</th>
                    <th>Nombre Artificio</th>
                    <th>Cantidad</th>
                    <th>Lugar / Destino</th>
                    <th>Beneficiario / Jornada</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($retiros as $r)
                    @foreach ($r->retiro_artificios as $ra)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $ra->artificio->name }}</td>
                            <td>{{ $ra->cantidad }}</td>
                            <td>{{ $r->lugar_destino??$r->coordinacion->name_coordinacion?? $r->beneficiario->nombre}}</td>
                            <td>
                                {{ $r->coordinacion->name_coordinacion 
                                    ?? $r->beneficiario->nombre 
                                    ?? $r->jornada->descripcion 
                                    ?? $r->ente->descripcion }}
                            </td>
                            <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
