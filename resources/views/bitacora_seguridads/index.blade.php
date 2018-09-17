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
				<a href="{{ route('bitacora_seguridads.bitacora_seguridad.index') }}">{{ trans('bitacora_seguridads.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('bitacora_seguridads.model_plural') }}</h4>
            </div>
            
            @ifUserCan('bitacora_seguridads.bitacora_seguridad.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('bitacora_seguridads.bitacora_seguridad.create') }}" class="btn btn-success btn-xs" title="{{ trans('bitacora_seguridads.create') }}">
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
                <a href="{{ route('bitacora_seguridads.bitacora_seguridad.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($bitacoraSeguridads) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('bitacora_seguridads.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('bitacora_seguridads.bitacora_seguridad.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
                                                    <label for="area_id" class="control-label">{{ trans('bitacora_seguridads.area_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="area_id" name="area_id">
                                                                    <option value="" style="display: none;" {{ old('area_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.area_id__placeholder') }}</option>
                                                                @foreach ($areas as $key => $area)
                                                                            <option value="{{ $key }}" {{ old('area_id') == $key ? 'selected' : '' }}>
                                                                                {{ $area }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>
                                                <div class="form-group col-md-4 {{ $errors->has('tpo_deteccion_id') ? 'has-error' : '' }}">
                                                    <label for="tpo_deteccion_id" class="control-label">{{ trans('bitacora_seguridads.tpo_deteccion_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="tpo_deteccion_id" name="tpo_deteccion_id">
                                                                    <option value="" style="display: none;" {{ old('tpo_deteccion_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.tpo_deteccion_id__placeholder') }}</option>
                                                                @foreach ($csTpoDeteccions as $key => $csTpoDeteccion)
                                                                            <option value="{{ $key }}" {{ old('tpo_deteccion_id') == $key ? 'selected' : '' }}>
                                                                                {{ $csTpoDeteccion }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('tpo_deteccion_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>
                                                <div class="form-group col-md-4 {{ $errors->has('tpo_inconformidad_id') ? 'has-error' : '' }}">
                                                    <label for="tpo_inconformidad_id" class="control-label">{{ trans('bitacora_seguridads.tpo_inconformidad_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="tpo_inconformidad_id" name="tpo_inconformidad_id">
                                                                    <option value="" style="display: none;" {{ old('tpo_inconformidad_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.tpo_inconformidad_id__placeholder') }}</option>
                                                                @foreach ($csTpoInconformidades as $key => $csTpoInconformidade)
                                                                            <option value="{{ $key }}" {{ old('tpo_inconformidad_id') == $key ? 'selected' : '' }}>
                                                                                {{ $csTpoInconformidade }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('tpo_inconformidad_id', '<p class="help-block">:message</p>') !!}
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

                <table class="table table-striped table-bordered table-hover tblEnc">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('bitacora_seguridads.entity_id') }}</th>
                            <th>{{ trans('bitacora_seguridads.fecha') }}</th>
                            <th>{{ trans('bitacora_seguridads.area_id') }}</th>
                            <th>{{ trans('bitacora_seguridads.tpo_deteccion_id') }}</th>
                            <th>{{ trans('bitacora_seguridads.tpo_inconformidad_id') }}</th>
                            <th>{{ trans('bitacora_seguridads.inconformidad') }}</th>
                            <th>{{ trans('bitacora_seguridads.estatus_id') }}</th>
                            <th>{{ trans('bitacora_seguridads.fec_planeada') }}</th>
                            <th>Dias Restantes</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bitacoraSeguridads as $bitacoraSeguridad)
                        <?php 
                        $dias = \Carbon\Carbon::now()->diffInDays($bitacoraSeguridad->fec_planeada);
                        ?>
                        <tr>
                            <td>{{ $bitacoraSeguridad->id }}</td>
                            <td>{{ $bitacoraSeguridad->entity->abreviatura }}</td>
                            <td>{{ $bitacoraSeguridad->fecha }}</td>
                            <td>{{ optional($bitacoraSeguridad->area)->area }}</td>
                            <td>{{ optional($bitacoraSeguridad->csTpoDeteccion)->tpo_deteccion }}</td>
                            <td>{{ optional($bitacoraSeguridad->csTpoInconformidade)->tpo_inconformidad }}</td>
                            <td>{{ $bitacoraSeguridad->inconformidad }}</td>
                            <td>
                                {{ optional($bitacoraSeguridad->sStB)->estatus }}
                                <a href="#" class="add-modalEstatus btn btn-xs btn-primary" data-bitacora_seguridad='{{$bitacoraSeguridad->id}}'>Cambiar</a>
                                <button class="btn btn-success btnVerComentarios pull-right btn-xs" lang="mesaj" data-bitacora_seguridad="{{$bitacoraSeguridad->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                                    <span class="fa fa-eye" aria-hidden="true"></span> Ver
                                </button>
                            </td>
                            <td>{{ $bitacoraSeguridad->fec_planeada }}</td>
                            <td>
                                @if($dias > $bitacoraSeguridad->dias_aviso)
                                    <span class='label label-danger'>
                                @elseif($dias = $bitacoraSeguridad->dias_aviso)
                                    <span class='label label-warning'>
                                @elseif($dias < $bitacoraSeguridad->dias_aviso)
                                    <span class='label label-success'>
                                @endif
                                {{ $dias}}</td>
                                </span>
                            </td>
                            
                            <td>

                                <form method="POST" action="{!! route('bitacora_seguridads.bitacora_seguridad.destroy', $bitacoraSeguridad->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('bitacora_seguridads.bitacora_seguridad.show')
                                        <a href="{{ route('bitacora_seguridads.bitacora_seguridad.show', $bitacoraSeguridad->id ) }}" class="btn btn-info btn-xs" title="{{ trans('bitacora_seguridads.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('bitacora_seguridads.bitacora_seguridad.edit')
                                        <a href="{{ route('bitacora_seguridads.bitacora_seguridad.edit', $bitacoraSeguridad->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('bitacora_seguridads.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('bitacora_seguridads.bitacora_seguridad.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('bitacora_seguridads.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_seguridads.confirm_delete') }}&quot;)">
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
            {!! $bitacoraSeguridads->render() !!}
        </div>
        
        @endif
    
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
                            <input type="hidden" name="bitacora_seguridad" id="bitacora_seguridad"  value=""> 
                            <div class="form-group col-md-12 {{ $errors->has('comentario') ? 'has-error' : '' }}">
                                <label for="comentario" class="control-label">{{ trans('comentarios_bs.comentario') }}</label>
                                <!--<div class="col-md-10">-->
                                    <input class="form-control input-sm " name="comentario" type="text" id="comentario" value="" minlength="1" maxlength="255" required="true" placeholder="{{ trans('comentarios_bs.comentario__placeholder') }}">
                                    {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
                                <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('costo') ? 'has-error' : '' }}">
                                <label for="costo" class="control-label">{{ trans('comentarios_bs.costo') }}</label>
                                <!--<div class="col-md-10">-->
                                    <input class="form-control input-sm " name="costo" type="number" id="costo" value="" min="-999999" max="999999" required="true" placeholder="{{ trans('comentarios_bs.costo__placeholder') }}" step="any">
                                    {!! $errors->first('costo', '<p class="help-block">:message</p>') !!}
                                <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
                                <label for="estatus_id" class="control-label">{{ trans('comentarios_bs.estatus_id') }}</label>
                                <!--<div class="col-md-10">-->
                                    <select class="form-control" id="estatus_id" name="estatus_id" required="true">
                                                <option value="" style="display: none;"  disabled selected>{{ trans('comentarios_bs.estatus_id__placeholder') }}</option>
                                            @foreach ($sStBs as $key => $sStB)
                                                        <option value="{{ $key }}" >
                                                            {{ $sStB }}
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
    $(document).on('click', '.add-modalEstatus', function() {
            $('.modal-title').text('Cambiar Estatus');
            $('#addModalEstatus').modal('show');
            $('#bitacora_seguridad').val($(this).data('bitacora_seguridad'));
        });
        
    $(document).on("change", "#estatus_id", function (e) {
        //alert('estatus');
        var miurl = "{{route('comentarios_bs.comentarios_b.store')}}";
        var data = new FormData();
        data.append('bitacora_seguridad_id', $('#bitacora_seguridad').val());
        data.append('comentario', $('#comentario').val());
        data.append('costo', $('#costo').val());
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
    
$(document).ready(function() {
    var $table = $('.tblEnc');
        
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
                    url: "{{route('comentarios_bs.comentarios_b.getComentarios')}}",
                    dataType: "json",
                    data: "bitacora_seguridad_id="+$(this).data('bitacora_seguridad'),
                    success: function (anaVeri) {

                    var yenitablosatir = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
                    '<td colspan="12">' +
                    '<table class="table table-condensed altTablo table-hover" width=100% >' +
                    '<thead>' +
                            '<tr>' +
                            '<th>Consecutivo</th>' +
                            '<th>Comentario</th>' +
                            '<th>Costo</th>' +
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
                              '<td>' + anaVeri[i].costo + '</td>' +
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
