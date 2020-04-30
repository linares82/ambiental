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
            <h3> BITACORA DE    MANTENIMIENTO </h3>
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
                Entidad
            </th>
            <th data-options="field:'residuo'" style="border:1px solid #ccc;">
                Area
            </th>
            <th data-options="field:'nombre'" style="border:1px solid #ccc;">
                Objetivo
            </th>
            <th data-options="field:'nombre'" style="border:1px solid #ccc;">
                Subequipo
            </th>
            <th data-options="field:'nombre'" style="border:1px solid #ccc;">
                Fecha Captura
            </th>
            <th data-options="field:'cantidad'" style="border:1px solid #ccc;">
                Fecha Inicio
            </th>
            <th data-options="field:'unidad'" style="border:1px solid #ccc;">
                No. Orden
            </th>
            <th data-options="field:'lugar_generacion'" style="border:1px solid #ccc;">
                Requiere TPP
            </th>
            <th data-options="field:'lugar_generacion'" style="border:1px solid #ccc;">
                Descripcion
            </th>
            <th data-options="field:'lugar_generacion'" style="border:1px solid #ccc;">
                Tipo
            </th>
            <th data-options="field:'lugar_generacion'" style="border:1px solid #ccc;">
                Ejecutor
            </th>
            <th data-options="field:'lugar_generacion'" style="border:1px solid #ccc;">
                Pormenores
            </th>
            <th data-options="field:'lugar_generacion'" style="border:1px solid #ccc;">
                Acción
            </th>
            <th data-options="field:'ubicacion'" style="border:1px solid #ccc;">
                Resultado
            </th>
            <th data-options="field:'ubicacion'" style="border:1px solid #ccc;">
                Fec. Final
            </th>
            <th data-options="field:'manifiesto'" style="border:1px solid #ccc;">
                Responsable Actividad
            </th>
            <th data-options="field:'peligroso'" style="border:1px solid #ccc;">
                Estatus
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($ms as $m)
        <tr>
            <td style="border:1px solid #ccc;height:60px">
                {{ optional($m->entity)->rzon_social }}
            </td>
            <td style="border:1px solid #ccc;">
		@php
		$subequipo=\App\Models\Subequipo::find($m->subequipo_id);
		@endphp
                {{ $subequipo->area->area }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ optional($m->mObjetivo)->objetivo }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $subequipo->subequipo }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $subequipo->created_at }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->fec_inicio }} {{ $m->hora_inicio }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->no_orden }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->Tpp->bnd }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->descripcion }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->mTpoManto->tpo_manto }}
            </td>

            <td style="border:1px solid #ccc;">
                {{ $m->ejecutor->nombre }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->observaciones }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->accion }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->resultado }}
            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->fec_final }} {{ $m->hora_fin }}
            </td>
            <td style="border:1px solid #ccc;">

            </td>
            <td style="border:1px solid #ccc;">
                {{ $m->mEstatus->estatus }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
    </body>
</html>


    <script type="text/php">
        if (isset($pdf))
            {
            $font = Font_Metrics::get_font("Arial", "bold");
            $pdf->page_text(670, 580, "Pagina {PAGE_NUM} de {PAGE_COUNT}", $font, 9, array(0, 0, 0));
            }
    </script>