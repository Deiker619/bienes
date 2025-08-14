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

        .info-table, .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .info-table td {
            padding: 4px;
            font-weight: bold;
        }

        .data-table th, .data-table td {
            border: 1.5px solid black;
            padding: 6px;
            text-align: center;
        }

        
    </style>
</head>
<body>
    
   

    <div class="nota-title">
        <img src="assets/images/cintillo.jpg" alt="" srcset="">
    </div>

   

    <table class="data-table">
        
            <tr>
                <th colspan="4">
                    NOTA DE SALIDA
                    
                </th>
                <th colspan="2">Nº {{$retiro->id}} - {{Date('Y')}}</th>
            </tr>
            <tr >
                <th colspan="2">DIRIGIDO A: {{$retiro->beneficiario->nombre }} <br>
                    V-{{$retiro->beneficiario->cedula }}</th>
                <th colspan="3">SEGURIDAD - ADMINISTRACIÓN</th>
                <th colspan="1">Fecha: {{ $retiro->created_at}}</th>
            </tr>
            <tr>
                <th colspan="1" height=20>Nro.</th>
                <th colspan="1" >Descripción</th>
                <th colspan="1">Unidad de medida</th>
                <th colspan="1">Cantidad</th>
                <th colspan="2">Observaciones</th>
               
            </tr>
            <tr>
                <th colspan="1" height=40>1</th>
                <th colspan="1">{{$retiro->artificio->name}}</th>
                <th colspan="1">Unidad</th>
                <th colspan="1">{{$retiro->cantidad_retirada}}</th>
                <th colspan="2">{{$retiro->observacion}}</th>
               
            </tr>
            <tr>
                <th colspan="3">Autorizado</th>
                <th colspan="3">Recibido por</th>
                
               
            </tr>
            <tr>
                <th height=200 colspan="3">
                    <br>
                    <br>
                    <br>
                    <div style="text-align: center">
                        <p style="padding: 0; margin: 0">Ing. Jeanne Nava</p>
                     
                        <p style="padding: 0; margin: 0">Directora</p>
                      
                        <p style="padding: 0; margin: 0">Fundación Misión José Gregorio Hernandez</p>
                     
                        <p style="padding: 0; margin: 0">Según Providencia Administrativa N°003-16 fecha de 05 de enero del 2016</p>
                    </div>
                </th>
                <th colspan="3">
                    <br>
                    <br>
                    <br>
                    <div style="text-align: center">
                        <p style="padding: 0; margin: 0">{{$retiro->nombre_tercero??$retiro->beneficiario->nombre}}</p>
                     
                        <p style="padding: 0; margin: 0">V-{{$retiro->cedula_tercero??$retiro->beneficiario->cedula}}</p>
                      
                       
                    </div>
                </th>
                
               
            </tr>
        
        
       
    </table>

   {{--  <table class="firmas">
        <tr>
            <td>
                <p>Autorizado:</p>
                <br><br><br>
                <strong>Ing. Jeanne Nava</strong><br>
                Directora<br>
                Fundación Misión José Gregorio Hernández
                <p class="stamp">Según Providencia Administrativa Nº003-16 de fecha 05 de enero de 2016</p>
            </td>
            <td>
                <p>Recibido Por:</p>
                <br><br><br>
                ___________________________<br>
                Firma y Cédula<br>
                Fecha: 09/06/2025
            </td>
        </tr>
    </table> --}}

</body>
</html>
