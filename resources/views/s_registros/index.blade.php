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
				<a href="{{ route('s_registros.s_registro.index') }}">{{ trans('s_registros.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('s_registros.model_plural') }}</h4>
            </div>
            
            @ifUserCan('s_registros.s_registro.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('s_registros.s_registro.create') }}" class="btn btn-success btn-xs" title="{{ trans('s_registros.create') }}">
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
                <a href="{{ route('s_registros.s_registro.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($sRegistros) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('s_registros.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('s_registros.s_registro.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
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

                <table class="table table-striped table-bordered table-hover tblEnc" id="postTable">
                    <thead>
                        <tr>
                            <th>{{ trans('s_registros.grupo_id') }}</th>
                            <th>{{ trans('s_registros.norma_id') }}</th>
                            <th>{{ trans('s_registros.elemento_id') }}</th>
                            <th>{{ trans('s_registros.detalle') }}</th>
                            <th>{{ trans('s_registros.archivo') }}</th>
                            <th>{{ trans('s_registros.fec_fin_vigencia') }}</th>
                            <th>Dias Restantes</th>
                            <th>{{ trans('s_registros.estatus_id') }}</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sRegistros as $sRegistro)
                        <?php 
                        $dias = \Carbon\Carbon::now()->diffInDays($sRegistro->fec_fin_vigencia);
                        ?>
                        <tr>
                            <td>{{ optional($sRegistro->csGrupoNorma)->grupo_norma }}</td>
                            <td>{{ optional($sRegistro->csNorma)->norma }}</td>
                            <td>{{ optional($sRegistro->csElementosInspeccion)->elemento }}</td>
                            <td>{{ $sRegistro->detalle }}</td>
                            <td>
                                <a href="#" class="add-modal btn btn-xs btn-warning" data-s_registro='{{$sRegistro->id}}'>Agregar</a>
                                <button class="btn btn-success btnVerLineas pull-right btn-xs" lang="mesaj" data-s_registro="{{$sRegistro->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                                    <span class="fa fa-eye" aria-hidden="true"></span> Ver
                                </button>
                            </td>
                            <td>{{ $sRegistro->fec_fin_vigencia }}</td>
                            <td>
                                @if($dias > $sRegistro->dias_aviso)
                                    <span class='label label-danger'>
                                @elseif($dias = $sRegistro->dias_aviso)
                                    <span class='label label-warning'>
                                @elseif($dias < $sRegistro->dias_aviso)
                                    <span class='label label-success'>
                                @endif
                                {{ $dias}}</td>
                                </span>
                            </td>
                            <td>{{ optional($sRegistro->sEstatusProcedimiento)->estatus }}
                                <a href="#" class="add-modalEstatus btn btn-xs btn-primary" data-s_registro='{{$sRegistro->id}}'>Cambiar</a>
                                <button class="btn btn-success btnVerComentarios pull-right btn-xs" lang="mesaj" data-s_registro="{{$sRegistro->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                                    <span class="fa fa-eye" aria-hidden="true"></span> Ver
                                </button>
                            </td>
                            
                            <td>

                                <form method="POST" action="{!! route('s_registros.s_registro.destroy', $sRegistro->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('s_registros.s_registro.show')
                                        <a href="{{ route('s_registros.s_registro.show', $sRegistro->id ) }}" class="btn btn-info btn-xs" title="{{ trans('s_registros.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('s_registros.s_registro.edit')
                                        <a href="{{ route('s_registros.s_registro.edit', $sRegistro->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('s_registros.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('s_registros.s_registro.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('s_registros.delete') }}" onclick="return confirm(&quot;{{ trans('s_registros.confirm_delete') }}&quot;)">
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
            {!! $sRegistros->render() !!}
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
                            <input type="hidden" name="s_registro" id="s_registro"  value=""> 
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
                            <input type="hidden" name="s_registro" id="s_registro"  value=""> 
                            <div class="form-group col-md-12 {{ $errors->has('comentario') ? 'has-error' : '' }}">
                                <label for="comentario" class="control-label">{{ trans('s_comentarios_registros.comentario') }}</label>
                                <!--<div class="col-md-10">-->
                                    <input class="form-control input-sm " name="comentario" type="text" id="comentario" value="" minlength="1" maxlength="255" required="true" placeholder="{{ trans('s_comentarios_registros.comentario__placeholder') }}">
                                    {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
                                <!--</div>-->
                            </div>

                            <div class="form-group col-md-12 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
                                <label for="estatus_id" class="control-label">{{ trans('s_comentarios_registros.estatus_id') }}</label>
                                <!--<div class="col-md-10">-->
                                    <select class="form-control" id="estatus_id" name="estatus_id" required="true">
                                                <option value="" style="display: none;"  disabled selected>{{ trans('s_comentarios_registros.estatus_id__placeholder') }}</option>
                                            @foreach ($sEstatusProcedimientos as $key => $sEstatusProcedimiento)
                                                        <option value="{{ $key }}" >
                                                            {{ $sEstatusProcedimiento }}
                                                        </option>
                                                    @endforeach
                                    </select>

                                    {!! $errors->first('estatus_id', '<p class="help-block">:message</p>') !!}
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
    //Abre ventana modal para cambiar estatus
    $(document).on('click', '.add-modalEstatus', function() {
            $('.modal-title').text('Cambiar Estatus');
            $('#addModalEstatus').modal('show');
            $('#s_registro').val($(this).data('s_registro'));
        });
    
    //Cambia y el estatus
    $(document).on("change", "#estatus_id", function (e) {
        //alert('estatus');
        var miurl = "{{route('s_comentarios_registros.s_comentarios_registro.store')}}";
        var data = new FormData();
        data.append('s_registros_id', $('#s_registro').val());
        data.append('comentario', $('#comentario').val());
        data.append('estatus_id', $('#estatus_id option:selected').val());

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
    
    // Abrir modal para Agregar un archivo
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Agregar Archivo');
            $('#addModal').modal('show');
            $('#s_registro').val($(this).data('s_registro'));
        });
        
    //Guarda el archivo
    $(document).on("change", ".email_archivo", function (e) {
        var miurl = "{{route('files_s_registros.files_s_registro.cargaArchivo')}}";
        // var fileup=$("#file").val();
        var divresul = "texto_notificacion";

        var data = new FormData();
        data.append('file', $('#file')[0].files[0]);
        data.append('s_registro', $('#s_registro').val());
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
    
    
$(document).ready(function() {
    var $table = $('.tblEnc');
    //ver archivos cargados    
    $table.find('.btnVerLineas').on('click', function(e) {

		var $btn = $(e.target), $tablosatir2 = $btn.closest('tr'), $tablosonrakisatir2 = $tablosatir2.next('tr.expand-child');
		
		if ( $btn.attr("lang") === "mesaj" ) {
		
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
                    url: "{{route('files_s_registros.files_s_registro.getFiles')}}",
                    dataType: "json",
                    data: "s_registro="+$(this).data('s_registro'),
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

                            var j=1;
                            $.each(anaVeri, function(i) {
                            var btnEliminarLn="";

                            btnEliminarLn='<button type="submit" class="btn btn-danger btn-xs" title="Eliminar" onclick="return confirm(&quot; Eliminar &quot;)">'+
                                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Eliminar'+
                            '</button>';

                            yenitablosatir2 += '<tr>' +
                              //kullaniciTomar.Surname      
                              '<td>' + j + '</td>' +
                              '<td>' + anaVeri[i].descripcion + '</td>' +
                              '<td><a href="'+anaVeri[i].file_path +'" alt="' +anaVeri[i].file_name + '" target="_blank">' + anaVeri[i].file_name + '</a></td>' +
                              '<td>'+
                                '<form method="POST" action="' + '{!! url('files_s_registros/files_s_registro/') !!}'+'/'+ anaVeri[i].id +'" accept-charset="UTF-8">'+
                                '<input name="_method" value="DELETE" type="hidden">'+
                                '{{ csrf_field() }}' +
                                btnEliminarLn +
                                '</form>'+
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
	
	if ( $btn.attr("lang") === "yorum" ) { 
        //////// yorum butonuna tıklandığında olan olaylar. (if clicked command buton)
        $table.find('.btnVerLineas').trigger('click');
        }
 	
	}); // on click .btnVerLineas end
        
    $table.find('.btnVerComentarios').on('click', function(e) {

		var $btn = $(e.target), $tablosatir = $btn.closest('tr'), $tablosonrakisatir = $tablosatir.next('tr.expand-child');
		
		if ( $btn.attr("lang") === "mesaj" ) {
		
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
                    url: "{{route('s_comentarios_registros.s_comentarios_registro.getComentarios')}}",
                    dataType: "json",
                    data: "s_registros_id="+$(this).data('s_registro'),
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

                            var j=1;
                            $.each(anaVeri, function(i) {
                            var btnEliminarLn="";

                            btnEliminarLn='<button type="submit" class="btn btn-danger btn-xs" title="Eliminar" onclick="return confirm(&quot; Eliminar &quot;)">'+
                                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Eliminar'+
                            '</button>';

                            yenitablosatir += '<tr>' +
                              //kullaniciTomar.Surname      
                              '<td>' + j + '</td>' +
                              '<td>' + anaVeri[i].comentario + '</td>' +
                              '<td>' + anaVeri[i].estatus + '</td>' +
                              '<td>'+
                                '<form method="POST" action="' + '{!! url('') !!}'+'/'+ anaVeri[i].id +'" accept-charset="UTF-8">'+
                                '<input name="_method" value="DELETE" type="hidden">'+
                                '{{ csrf_field() }}' +
                                '</form>'+
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
	
	if ( $btn.attr("lang") === "yorum" ) { 
        //////// yorum butonuna tıklandığında olan olaylar. (if clicked command buton)
        $table.find('.btnVerComentarios').trigger('click');
        }
 	
	}); // on click .btnVerLineas end    


});

</script>
@endpush
