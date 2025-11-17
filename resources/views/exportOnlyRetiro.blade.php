<div>
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
        <div class="nota-title">
            <img src="assets/images/cintillo2.png" alt="">
        </div>

        <h1>Reporte de retiro {{ $retiros->id }}</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Artificio</th>
                        <th>Cantidad Retirada</th>
                        <th>Lugar Destino</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí puedes agregar filas dinámicamente desde PHP -->

                    @foreach ($retiros->retiro_artificios as $detalle)
                        <tr>
                            <td>{{ $retiros->id }}</td>

                            {{-- Nombre --}}
                            <td>{{ $detalle->artificio->name }}</td>

                            {{-- Cantidad retirada --}}
                            <td>{{ $detalle->cantidad }}</td>

                            {{-- Destino --}}
                            <td>
                                {{ $retiros->coordinacion->name_coordinacion ??
                                    ($retiros->beneficiario->nombre ?? $retiros->jornada->descripcion) }}
                            </td>

                            <td>{{ $retiros->created_at }}</td>
                        </tr>
                    @endforeach
                    <!-- Añade más filas según sea necesario -->
                </tbody>
            </table>
        </div>

    </div>
</div>
