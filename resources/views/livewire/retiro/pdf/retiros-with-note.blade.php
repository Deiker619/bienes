<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 20px;
            font-size: 16px
        }

        body {
            font-family: DejaVu Sans, sans-serif;

        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header div {
            line-height: 1.3;
        }

        .nota-title {
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .info-table,
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .info-table td {
            padding: 4px;
            font-weight: bold;
        }

        .data-table th,
        .data-table td {
            border: 1.5px solid black;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>



<div class="nota-title">
    <img src="assets/images/cintillo2.png" alt="" style="max-width: 1100px; width: 100%; height: auto;">
</div>


    <table class="data-table">

        <tr>
            <th colspan="4">
                NOTA DE ENTREGA

            </th>
            <th colspan="2">Nº {{ $retiro->id }} - {{ Date('Y') }}</th>
        </tr>
        <tr>
            <th colspan="2">BENEFICIARIO:
                @if ($retiro->beneficiario)
                    {{ $retiro->beneficiario->nombre }} <br>
                    V-{{ $retiro->beneficiario->cedula }}
            </th>
            @endif

            @if ($retiro->coordinacion)
                {{ $retiro->coordinacion->name_coordinacion }} <br>
            @endif
            <th colspan="3">FMJGH - {{ env('APP_GERENCIA') }}</th>
            <th colspan="1">Fecha: {{ $retiro->created_at }}</th>
        </tr>
        <tr>
            <th colspan="1" height=20>ID.</th>
            <th colspan="1">Descripción</th>
            <th colspan="1">Unidad de medida</th>
            <th colspan="1">Cantidad</th>
            <th colspan="2">Observaciones</th>

        </tr>
        @foreach ($retiro->retiro_artificios as $artificios)
            <tr>
                <th colspan="1" height=40>{{$artificios->artificio->id}}</th>
                <th colspan="1">{{ $artificios->artificio->name }}</th>
                <th colspan="1">Unidad</th>
                <th colspan="1">{{ $artificios->cantidad }}</th>

                <th colspan="2">{{ $retiro->observacion }}</th>
            </tr>
        @endforeach
        <tr>
            <th colspan="2">Autorizado</th>
            <th colspan="2">Entregado por</th>
            <th colspan="2">Recibido por</th>


        </tr>
        <tr>
            <th height=100 colspan="2">
                <br>
                <br>
                <br>
                <div style="text-align: center">
                    <p style="padding: 0; margin: 0">{{env('APP_GERENTE')}}</p>

                    <p style="padding: 0; margin: 0">{{env('APP_CARGO')}}</p>

                    <p style="padding: 0; margin: 0">Fundación Misión José Gregorio Hernandez</p>

                    <p style="padding: 0; margin: 0">Según Providencia Administrativa N°003-16 fecha de 05 de enero del
                        2016</p>
                </div>
            </th>
            <th colspan="2">
                <br>
                <br>
                <br>
                <div style="text-align: center">

                    <p style="padding: 0; margin: 0">
                        {{ auth()->user()->name }}
                    </p>

                    

                </div>
            </th>
            <th colspan="2">
                <br>
                <br>
                <br>
                <div style="text-align: center">

                    <p style="padding: 0; margin: 0">
                        {{ $retiro->nombre_tercero ?? ($retiro->beneficiario->nombre ?? $retiro->coordinacion->name_coordinacion) }}
                    </p>

                    <p style="padding: 0; margin: 0">
                        @if ($retiro->cedula_tercero || $retiro->beneficiario)
                            V-
                        @endif
                        {{ $retiro->cedula_tercero ?? ($retiro->beneficiario->cedula ?? '') }}
                    </p>


                </div>
            </th>


        </tr>



    </table>


</body>

</html>
