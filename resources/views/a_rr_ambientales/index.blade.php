@extends('layouts.master1')

@section('content')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <a href="{{route('home')}}">
                <i class="ace-icon fa fa-home home-icon"></i>
            </a>
        </li>

        <li>
            <a href="{{ route('a_rr_ambientales.a_rr_ambientale.index') }}">{{ trans('a_rr_ambientales.model_plural') }}</a>
        </li>
    </ul><!-- /.breadcrumb -->
</div>

@if(Session::has('success_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    {!! session('success_message') !!}

    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif

<div class="panel panel-default">

    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ trans('a_rr_ambientales.model_plural') }}</h4>
        </div>

        @ifUserCan('a_rr_ambientales.a_rr_ambientale.create')
        <div class="btn-group btn-group-sm pull-right" role="group">
            <a href="{{ route('a_rr_ambientales.a_rr_ambientale.create') }}" class="btn btn-success btn-xs" title="{{ trans('a_rr_ambientales.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        </div>
        @endif
        <div class="btn-group btn-group-sm pull-right" role="group">
            <button id="search_btn" class="btn btn-warning btn-xs" title="Buscar">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </button>
        </div>
        <div class="btn-group btn-group-sm pull-right" role="group">
            <a href="{{ route('a_rr_ambientales.a_rr_ambientale.index') }}" class="btn btn-xs" title="Refrescar">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($aRrAmbientales) == 0)
    <div class="panel-body text-center">
        <h4>{{ trans('a_rr_ambientales.none_available') }}</h4>
    </div>
    @else
    <div class="panel-body panel-body-with-table">
        <div class="row" >
            <div class="col-md-12">
                <form method="GET" action="{{ route('a_rr_ambientales.a_rr_ambientale.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="GET">
                    <div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
                        <label for="id" class="control-label">Id</label>
                        <input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('material_id') ? 'has-error' : '' }}">
                        <label for="material_id" class="control-label">{{ trans('a_rr_ambientales.material_id') }}</label>
                        <!--<div class="col-md-10">-->
                        <select class="form-control chosen" id="material_id" name="material_id">
                            <option value="" style="display: none;" {{ old('material_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.material_id__placeholder') }}</option>
                            @foreach ($caMaterials as $key => $caMaterial)
                            <option value="{{ $key }}" {{ old('material_id') == $key ? 'selected' : '' }}>
                                    {{ $caMaterial }}
                        </option>
                        @endforeach
                    </select>

                    {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
                    <!--</div>-->
                </div>

                <div class="form-group col-md-4 {{ $errors->has('categoria_id') ? 'has-error' : '' }}">
                    <label for="categoria_id" class="control-label">{{ trans('a_rr_ambientales.categoria_id') }}</label>
                    <!--<div class="col-md-10">-->
                    <select class="form-control chosen" id="categoria_id" name="categoria_id">
                        <option value="" style="display: none;" {{ old('categoria_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.categoria_id__placeholder') }}</option>
                        @foreach ($caCategorias as $key => $caCategorium)
                        <option value="{{ $key }}" {{ old('categoria_id') == $key ? 'selected' : '' }}>
                                {{ $caCategorium }}
                    </option>
                    @endforeach
                </select>

                {!! $errors->first('categoria_id', '<p class="help-block">:message</p>') !!}
                <!--</div>-->
            </div>

            <div class="form-group col-md-4 {{ $errors->has('documento_id') ? 'has-error' : '' }}">
                <label for="documento_id" class="control-label">{{ trans('a_rr_ambientales.documento_id') }}</label>
                <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="documento_id" name="documento_id">
                    <option value="" style="display: none;" {{ old('documento_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.documento_id__placeholder') }}</option>
                    @foreach ($caAaDocs as $key => $caAaDoc)
                    <option value="{{ $key }}" {{ old('documento_id') == $key ? 'selected' : '' }}>
                            {{ $caAaDoc }}
                </option>
                @endforeach
            </select>

            {!! $errors->first('documento_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input class="btn btn-info btn-app btn-xs" type="submit" value="Buscar">
            </div>
        </div>
    </form>
</div>
</div>
<div class="table-responsive">

    <table class="table table-striped table-bordered table-hover tblEnc" id="postTable"
           <thead>
            <tr>
                <th>Id</th>
                <th>{{ trans('a_rr_ambientales.entity_id') }}</th>
                <th>{{ trans('a_rr_ambientales.material_id') }}</th>
                <th>{{ trans('a_rr_ambientales.categoria_id') }}</th>
                <th>{{ trans('a_rr_ambientales.documento_id') }}</th>
                <th>{{ trans('a_rr_ambientales.descripcion') }}</th>
                <th>{{ trans('a_rr_ambientales.archivo') }}</th>
                <th>{{ trans('a_rr_ambientales.st_archivo_id') }}</th>
                <th>{{ trans('a_rr_ambientales.fec_fin_vigencia') }}</th>
                <th>Dias Restantes</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($aRrAmbientales as $aRrAmbientale)
            <?php
            $dias = \Carbon\Carbon::now()->diffInDays($aRrAmbientale->fec_fin_vigencia);
            ?>
            <tr>
                <td>{{ $aRrAmbientale->id }}</td>
                <td>{{ $aRrAmbientale->entity->abreviatura }}</td>
                <td>{{ optional($aRrAmbientale->caMaterial)->material }}</td>
                <td>{{ optional($aRrAmbientale->caCategoria)->categoria }}</td>
                <td>{{ optional($aRrAmbientale->caAaDoc)->doc }}</td>
                <td>{{ $aRrAmbientale->descripcion }}</td>
                <td>
                    <a href="#" class="add-modal btn btn-xs btn-warning" data-a_rr_ambientale='{{$aRrAmbientale->id}}'>Agregar</a>
                    <button class="btn btn-success btnVerLineas pull-left btn-xs" lang="mesaj" data-a_rr_ambientale="{{$aRrAmbientale->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                        <span class="fa fa-eye" aria-hidden="true"></span> Ver
                    </button>
                </td>
                <td>{{ optional($aRrAmbientale->aStArchivo)->estatus }}
                    <a href="#" class="add-modalEstatus btn btn-xs btn-primary" data-a_rr_ambientale='{{$aRrAmbientale->id}}'>Cambiar</a>
                    <button class="btn btn-success btnVerComentarios pull-right btn-xs" lang="mesaj" data-a_rr_ambientale="{{$aRrAmbientale->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                        <span class="fa fa-eye" aria-hidden="true"></span> Ver
                    </button>
                </td>
                <td>{{ $aRrAmbientale->fec_fin_vigencia }}</td>
                <td>
                    @if($dias > $aRrAmbientale->dias_aviso and \Carbon\Carbon::now()->lt($aRrAmbientale->fec_fin_vigencia))
                        <span class='label label-success'>
                    @elseif($dias <= $aRrAmbientale->dias_aviso and \Carbon\Carbon::now()->lt($aRrAmbientale->fec_fin_vigencia))
                        <span class='label label-warning'>
                    @elseif($dias > 0 and \Carbon\Carbon::now()->gt($aRrAmbientale->fec_fin_vigencia))
                        <span class='label label-danger' >
                    @endif
                                {{ $dias}}</td>
                            </span>
                            </td>

                            <td>

                                <form method="POST" action="{!! route('a_rr_ambientales.a_rr_ambientale.destroy', $aRrAmbientale->id) !!}" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('a_rr_ambientales.a_rr_ambientale.show')
                                        <a href="{{ route('a_rr_ambientales.a_rr_ambientale.show', $aRrAmbientale->id ) }}" class="btn btn-info btn-xs" title="{{ trans('a_rr_ambientales.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('a_rr_ambientales.a_rr_ambientale.edit')
                                        <a href="{{ route('a_rr_ambientales.a_rr_ambientale.edit', $aRrAmbientale->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('a_rr_ambientales.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('a_rr_ambientales.a_rr_ambientale.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('a_rr_ambientales.delete') }}" onclick="return confirm(&quot;{{ trans('a_rr_ambientales.confirm_delete') }}& quot; )">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        @endif
                                    </div>

                                </form>

                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>

                            </div>
                            </div>

                            <div class="panel-footer">
                                {!! $aRrAmbientales->render() !!}
                            </div>

                            @endif

                            </div>
                            <!-- Modal img -->
                            <div id="addModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h4 class="modal-title"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                <form class="" role="form" enctype="multipart/form-data" method="post" accept-charset="UTF-8">
                                                    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
                                                    <input type="hidden" name="a_rr_ambientale" id="a_rr_ambientale"  value=""> 
                                                    <div class="form-group col-md-12">
                                                        <label for="descripcion" class="control-label">Descripción</label><br>
                                                        <input type="text" name="descripcion" id="descripcion"  value="" placeholder="Descripción" class="form-control input-sm"> 
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <div class="btn btn-default btn-file">
                                                            <i class="fa fa-paperclip"></i> Adjuntar Archivo
                                                            <input type="file"  id="file" name="file" class="email_archivo" >
                                                            <input type="hidden"  id="file_hidden" name="file_hidden" >
                                                        </div>
                                                        <p class="help-block"  >Max. 20MB</p>
                                                        <div id="texto_notificacion">

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal">
                                                    <span class='glyphicon glyphicon-remove'></span> Cerrar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    

                            <!-- Modal Estatus -->
                            <div id="addModalEstatus" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h4 class="modal-title"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                <form class="" role="form" enctype="multipart/form-data" method="post" accept-charset="UTF-8">
                                                    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
                                                    <input type="hidden" name="a_rr_ambientale" id="a_rr_ambientale"  value=""> 
                                                    <div class="form-group col-md-12 {{ $errors->has('comentario') ? 'has-error' : '' }}">
                                                        <label for="comentario" class="control-label">{{ trans('a_comentarios_rrs.comentario') }}</label>
                                                        <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="comentario" type="text" id="comentario" value="" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_comentarios_rrs.comentario__placeholder') }}">
                                                        {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
                                                        <!--</div>-->
                                                    </div>

                                                    <div class="form-group col-md-12 {{ $errors->has('a_st_rr_id') ? 'has-error' : '' }}">
                                                        <label for="a_st_rr_id" class="control-label">{{ trans('a_comentarios_rrs.a_st_rr_id') }}</label>
                                                        <!--<div class="col-md-10">-->
                                                        <select class="form-control" id="a_st_rr_id" name="a_st_rr_id" required="true">
                                                            <option value="" style="display: none;"  disabled selected>{{ trans('a_comentarios_rrs.a_st_rr_id__placeholder') }}</option>
                                                            @foreach ($aStRrs as $key => $aStRr)
                                                            <option value="{{ $key }}" >
                                                                {{ $aStRr }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        {!! $errors->first('a_st_rr_id', '<p class="help-block">:message</p>') !!}
                                                        <!--</div>-->
                                                    </div>


                                                </form>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal">
                                                    <span class='glyphicon glyphicon-remove'></span> Cerrar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            @endsection


                            @push('scripts')
                            <script>
                                $(window).load(function(){
                                $('#postTable').removeAttr('style');
                                })
                            </script>

                            <script type="text/javascript">
                                        $(document).on('click', '.add-modalEstatus', function() {
                                $('.modal-title').text('Cambiar Estatus');
                                $('#addModalEstatus').modal('show');
                                $('#a_rr_ambientale').val($(this).data('a_rr_ambientale'));
                                });
                                $(document).on("change", "#a_st_rr_id", function (e) {
                                //alert('estatus');
                                var miurl = "{{route('a_comentarios_rrs.a_comentarios_rrs.store')}}";
                                var data = new FormData();
                                data.append('a_rr_id', $('#a_rr_ambientale').val());
                                data.append('comentario', $('#comentario').val());
                                data.append('a_st_rr_id', $('#a_st_rr_id option:selected').val());
                                $.ajaxSetup({
                                headers: {
                                'X-CSRF-TOKEN': $('#_token').val()
                                }
                                });
                                $.ajax({
                                url: miurl,
                                        type: 'POST',
                                        // Form data
                                        //datos del formulario
                                        data: data,
                                        //necesario para subir archivos via ajax
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        //mientras enviamos el archivo
                                        beforeSend: function () {
                                        //$("#" + divresul + "").html($("#cargador_empresa").html());
                                        },
                                        //una vez finalizado correctamente
                                        success: function (data) {
                                        location.reload();
                                        },
                                        //si ha ocurrido un error
                                        error: function (data) {


                                        }
                                });
                                })


                            // add a new post
                                        $(document).on('click', '.add-modal', function() {
                                $('.modal-title').text('Agregar Archivo');
                                $('#addModal').modal('show');
                                $('#a_rr_ambientale').val($(this).data('a_rr_ambientale'));
                                });
                                $(document).on("change", ".email_archivo", function (e) {
                                var miurl = "{{route('files_a_rr_ambientales.files_a_rr_ambientale.cargaArchivo')}}";
                                // var fileup=$("#file").val();
                                var divresul = "texto_notificacion";
                                var data = new FormData();
                                data.append('file', $('#file')[0].files[0]);
                                data.append('a_rr_ambiental_id', $('#a_rr_ambientale').val());
                                data.append('descripcion', $('#descripcion').val());
                                $.ajaxSetup({
                                headers: {
                                'X-CSRF-TOKEN': $('#_token').val()
                                }
                                });
                                $.ajax({
                                url: miurl,
                                        type: 'POST',
                                        // Form data
                                        //datos del formulario
                                        data: data,
                                        //necesario para subir archivos via ajax
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        //mientras enviamos el archivo
                                        beforeSend: function () {
                                        $("#" + divresul + "").html($("#cargador_empresa").html());
                                        },
                                        //una vez finalizado correctamente
                                        success: function (data) {
                                        location.reload();
                                        },
                                        //si ha ocurrido un error
                                        error: function (data) {


                                        }
                                });
                                })

                                        $(document).ready(function() {
                                var $table = $('.tblEnc');
                                $table.find('.btnVerLineas').on('click', function(e) {

                                var $btn = $(e.target), $tablosatir2 = $btn.closest('tr'), $tablosonrakisatir2 = $tablosatir2.next('tr.expand-child');
                                if ($btn.attr("lang") === "mesaj") {

                                if ($tablosonrakisatir2.css("display") === 'none') {
                                // if panel close !
                                $tablosonrakisatir2.slideDown(100);
                                } else {
                                // if panel open !
                                $("#postTable .expand-child").remove();
                                $tablosonrakisatir2.slideUp(100);
                                }

                                if ($tablosonrakisatir2.length) {
                                } else
                                {

                                // sonraki satır var ise	
                                $.ajax({
                                url: "{{route('files_a_rr_ambientales.files_a_rr_ambientale.getFiles')}}",
                                        dataType: "json",
                                        data: "a_rr_ambientale=" + $(this).data('a_rr_ambientale'),
                                        success: function (anaVeri) {

                                        var yenitablosatir2 = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
                                                '<td colspan="12">' +
                                                '<table class="table table-condensed altTablo table-hover" width=100% >' +
                                                '<thead>' +
                                                '<tr>' +
                                                '<th>Consecutivo</th>' +
                                                '<th>Descripcion</th>' +
                                                '<th>Archivo</th>' +
                                                '<th></th>' +
                                                '</tr>' +
                                                '</thead>' +
                                                '<tbody>';
                                        //if (anaVeri.kullanici) {
                                        if (anaVeri) {
                                        //$.each(anaVeri.kullanici, function(i, kullaniciTomar) {

                                        var j = 1;
                                        $.each(anaVeri, function(i) {
                                        var btnEliminarLn = "";
                                        btnEliminarLn = '<button type="submit" class="btn btn-danger btn-xs" title="Eliminar" onclick="return confirm(&quot; Eliminar &quot;)">' +
                                                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Eliminar' +
                                                '</button>';
                                        yenitablosatir2 += '<tr>' +
                                                //kullaniciTomar.Surname      
                                                '<td>' + j + '</td>' +
                                                '<td>' + anaVeri[i].descripcion + '</td>' +
                                                '<td><a href="' + anaVeri[i].file_path + '" alt="' + anaVeri[i].file_name + '" target="_blank">' + anaVeri[i].file_name + '</a></td>' +
                                                '<td>' +
                                                '<form method="POST" action="' + '{!! url('files_a_rr_ambientales / files_a_rr_ambientale / ') !!}' + '/' + anaVeri[i].id + '" accept-charset="UTF-8">' +
                                                '<input name="_method" value="DELETE" type="hidden">' +
                                                '{{ csrf_field() }}' +
                                                btnEliminarLn +
                                                '</form>' +
                                                '</td>' +
                                                '</tr>';
                                        j++;
                                        });
                                        }
                                        yenitablosatir2 += '</tbody></table></td></tr>';
                                        // set next row
                                        $tablosonrakisatir2 = $(yenitablosatir2).insertAfter($tablosatir2);
                                        }
                                });
                                }
                                } // if click mesaj buton!

                                if ($btn.attr("lang") === "yorum") {
                                //////// yorum butonuna tıklandığında olan olaylar. (if clicked command buton)
                                $table.find('.btnVerLineas').trigger('click');
                                }

                                }); // on click .btnVerLineas end


                                $table.find('.btnVerComentarios').on('click', function(e) {

                                var $btn = $(e.target), $tablosatir = $btn.closest('tr'), $tablosonrakisatir = $tablosatir.next('tr.expand-child');
                                if ($btn.attr("lang") === "mesaj") {

                                if ($tablosonrakisatir.css("display") === 'none') {
                                // if panel close !
                                $tablosonrakisatir.slideDown(100);
                                } else {
                                // if panel open !
                                $("#postTable .expand-child").remove();
                                $tablosonrakisatir.slideUp(100);
                                }

                                if ($tablosonrakisatir.length) {
                                } else
                                {

                                // sonraki satır var ise	
                                $.ajax({
                                url: "{{route('a_comentarios_rrs.a_comentarios_rrs.getComentarios')}}",
                                        dataType: "json",
                                        data: "a_rr_ambientale=" + $(this).data('a_rr_ambientale'),
                                        success: function (anaVeri) {

                                        var yenitablosatir = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
                                                '<td colspan="12">' +
                                                '<table class="table table-condensed altTablo table-hover" width=100% >' +
                                                '<thead>' +
                                                '<tr>' +
                                                '<th>Consecutivo</th>' +
                                                '<th>Comentario</th>' +
                                                '<th>Estatus</th>' +
                                                '<th></th>' +
                                                '</tr>' +
                                                '</thead>' +
                                                '<tbody>';
                                        //if (anaVeri.kullanici) {
                                        if (anaVeri) {
                                        //$.each(anaVeri.kullanici, function(i, kullaniciTomar) {

                                        var j = 1;
                                        $.each(anaVeri, function(i) {
                                        var btnEliminarLn = "";
                                        btnEliminarLn = '<button type="submit" class="btn btn-danger btn-xs" title="Eliminar" onclick="return confirm(&quot; Eliminar &quot;)">' +
                                                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Eliminar' +
                                                '</button>';
                                        yenitablosatir += '<tr>' +
                                                //kullaniciTomar.Surname      
                                                '<td>' + j + '</td>' +
                                                '<td>' + anaVeri[i].comentario + '</td>' +
                                                '<td>' + anaVeri[i].estatus + '</td>' +
                                                '<td>' +
                                                '<form method="POST" action="' + '{!! url('') !!}' + '/' + anaVeri[i].id + '" accept-charset="UTF-8">' +
                                                '<input name="_method" value="DELETE" type="hidden">' +
                                                '{{ csrf_field() }}' +
                                                '</form>' +
                                                '</td>' +
                                                '</tr>';
                                        j++;
                                        });
                                        }
                                        yenitablosatir += '</tbody></table></td></tr>';
                                        // set next row
                                        $tablosonrakisatir = $(yenitablosatir).insertAfter($tablosatir);
                                        }
                                });
                                }
                                } // if click mesaj buton!

                                if ($btn.attr("lang") === "yorum") {
                                //////// yorum butonuna tıklandığında olan olaylar. (if clicked command buton)
                                $table.find('.btnVerComentarios').trigger('click');
                                }

                                }); // on click .btnVerLineas end    


                                });

                            </script>
                            @endpush
