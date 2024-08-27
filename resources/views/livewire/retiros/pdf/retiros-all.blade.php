<div>
    <div>
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
            <h1>Reporte de retiro </h1>
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
                        @foreach ($retiros as $r)
                            
                        <tr>
                            <td>{{$r->id}}</td>
                            <td>{{$r->artificio->name}}</td>
                            <td>{{$r->cantidad_retirada}}</td>
                            <td>{{$r->coordinacion->name_coordinacion ?? $r->beneficiario->nombre ?? $r->jornada->descripcion}}</td>
                            <td>{{$r->created_at}}</td>
                        </tr>
                        @endforeach
                        <!-- Añade más filas según sea necesario -->
                    </tbody>
                </table>
            </div>
            
        </div>
        </div>
        
</div>
