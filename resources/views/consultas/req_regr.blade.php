<html>
    <head>
        <style>
        @media print {
           table, th, td
            {
                border-collapse:collapse;
                border: 1px solid black;
                width:100%;
                text-align:right;
            }
        }
        </style>

    </head>
    <body>
        <div id="printeArea">
            <table style="width:100%;height:auto;border:1px solid #ccc;font-size: 0.75em;">
                <tr>
                    <td style="width:33%;text-align:right" align="right">
                        <img src="{{$img}}" alt="Logo" height=80>
                    </td>
                    <td style="width:33%;text-align:center" align="center">
                        <h3> Avances: {{$entidad}} </h3>
                    </td>
                    <td style="width:33%;text-align:left" align="left">
                        Fecha de Elaboración: {{$fecha}}
                    </td>
                </tr>
            </table>

            <table id="dg" style="width:100%;height:auto;border-collapse: collapse;font-size: 0.75em;">
                <thead>
                    <tr>
                        <th data-options="field:'cia_id'" style="border:1px solid #ccc;">
                            Material
                        </th>
                        <th data-options="field:'residuo'" style="border:1px solid #ccc;">
                            Categoria
                        </th>
                        <th data-options="field:'unidad'" style="border:1px solid #ccc;">
                            Documento
                        </th>
                        <th data-options="field:'peligroso'" style="border:1px solid #ccc;">
                            Descripción
                        </th>
                        <th data-options="field:'nombre'" style="border:1px solid #ccc;">
                            Fecha Fin Vigencia
                        </th>
                        <th data-options="field:'fecha'" style="border:1px solid #ccc;">
                            Responsable
                        </th>
                        <th data-options="field:'lugar_generacion'" style="border:1px solid #ccc;">
                            Estatus
                        </th>
                        <th data-options="field:'cantidad'" style="border:1px solid #ccc;">
                            Avance
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $suma=0; ?>
                    @foreach($datos as $r)
                    <tr>
                        <td style="border:1px solid #ccc;">
                            {{ $r->material }}
                        </td>
                        <td style="border:1px solid #ccc;">
                            {{ $r->categoria }}
                        </td>
                        <td style="border:1px solid #ccc;">
                            {{ $r->doc }}
                        </td>
                        <td style="border:1px solid #ccc;">
                            {{ $r->descripcion }}
                        </td>
                        <td style="border:1px solid #ccc;">
                            {{ $r->fec_fin_vigencia }}
                        </td>
                        <td style="border:1px solid #ccc;">
                            {{ $r->responsable }}
                        </td>
                        <td style="border:1px solid #ccc;">
                            {{ $r->estatus }}
                        </td>
                        <td style="border:1px solid #ccc;">
                            {{ $r->avance }}
                            <?php $suma=$suma+$r->avance ?>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6"></td>
                        <td> Avance General </td>
                        <td> {{ $suma/$cantidad }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
            
                <script type="text/php">
                    if (isset($pdf))
                        {
                        $font = Font_Metrics::get_font("Arial", "bold");
                        $pdf->page_text(670, 580, "Pagina {PAGE_NUM} de {PAGE_COUNT}", $font, 9, array(0, 0, 0));
                        }
                </script>
            
    </body>
</html>

