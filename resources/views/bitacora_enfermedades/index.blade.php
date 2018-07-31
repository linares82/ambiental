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
				<a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.index') }}">{{ trans('bitacora_enfermedades.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('bitacora_enfermedades.model_plural') }}</h4>
            </div>
            
            @ifUserCan('bitacora_enfermedades.bitacora_enfermedade.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.create') }}" class="btn btn-success btn-xs" title="{{ trans('bitacora_enfermedades.create') }}">
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
                <a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($bitacoraEnfermedades) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('bitacora_enfermedades.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('bitacora_enfermedades.bitacora_enfermedade.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
                                                    <label for="area_id" class="control-label">{{ trans('bitacora_enfermedades.area_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="area_id" name="area_id">
                                                                    <option value="" style="display: none;" {{ old('area_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_enfermedades.area_id__placeholder') }}</option>
                                                                @foreach ($areas as $key => $area)
                                                                            <option value="{{ $key }}" {{ old('area_id') == $key ? 'selected' : '' }}>
                                                                                {{ $area }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>
                                                <div class="form-group col-md-4 {{ $errors->has('enfermedad_id') ? 'has-error' : '' }}">
                                                    <label for="enfermedad_id" class="control-label">{{ trans('bitacora_enfermedades.enfermedad_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="enfermedad_id" name="enfermedad_id">
                                                                    <option value="" style="display: none;" {{ old('enfermedad_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_enfermedades.enfermedad_id__placeholder') }}</option>
                                                                @foreach ($csEnfermedades as $key => $csEnfermedade)
                                                                            <option value="{{ $key }}" {{ old('enfermedad_id') == $key ? 'selected' : '' }}>
                                                                                {{ $csEnfermedade }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('enfermedad_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>
                                                <div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
                                                    <label for="fecha" class="control-label">{{ trans('bitacora_enfermedades.fecha') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha') }}" placeholder="{{ trans('bitacora_enfermedades.fecha__placeholder') }}">
                                                        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
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

                <table class="table table-striped table-bordered table-hover tblEnc" id="postTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('bitacora_enfermedades.area_id') }}</th>
                            <th>{{ trans('bitacora_enfermedades.fecha') }}</th>
                            <th>{{ trans('bitacora_enfermedades.enfermedad_id') }}</th>
                            <th>{{ trans('bitacora_enfermedades.turno_id') }}</th>
                            <th>{{ trans('a_procedimientos.archivo') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bitacoraEnfermedades as $bitacoraEnfermedade)
                        <tr>
                            <td>{{ $bitacoraEnfermedade->id }}</td>
                            <td>{{ optional($bitacoraEnfermedade->area)->area }}</td>
                            <td>{{ $bitacoraEnfermedade->fecha }}</td>
                            <td>{{ optional($bitacoraEnfermedade->csEnfermedade)->enfermedad }}</td>
                            <td>{{ optional($bitacoraEnfermedade->turno)->turno }}</td>
                            <td>
                                <a href="#" class="add-modal btn btn-xs btn-warning" data-bitacora_enfermedade_id='{{$bitacoraEnfermedade->id}}'>Agregar</a>
                                <button class="btn btn-success btnVerLineas pull-right btn-xs" lang="mesaj" data-bitacora_enfermedade_id="{{$bitacoraEnfermedade->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                                    <span class="fa fa-eye" aria-hidden="true"></span> Ver
                                </button>
                            </td>
                            <td>

                                <form method="POST" action="{!! route('bitacora_enfermedades.bitacora_enfermedade.destroy', $bitacoraEnfermedade->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('bitacora_enfermedades.bitacora_enfermedade.show')
                                        <a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.show', $bitacoraEnfermedade->id ) }}" class="btn btn-info btn-xs" title="{{ trans('bitacora_enfermedades.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('bitacora_enfermedades.bitacora_enfermedade.edit')
                                        <a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.edit', $bitacoraEnfermedade->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('bitacora_enfermedades.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('bitacora_enfermedades.bitacora_enfermedade.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('bitacora_enfermedades.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_enfermedades.confirm_delete') }}&quot;)">
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
            {!! $bitacoraEnfermedades->render() !!}
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
                            <input type="hidden" name="bitacora_enfermedade" id="bitacora_enfermedade"  value=""> 
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
    
@endsection

@push('scripts')
<script>
    $(window).load(function(){
        $('#postTable').removeAttr('style');
    })
</script>

<script type="text/javascript">
    
// add a new post
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Agregar Archivo');
            $('#addModal').modal('show');
            $('#bitacora_enfermedade').val($(this).data('bitacora_enfermedade_id'));
        });
        
    $(document).on("change", ".email_archivo", function (e) {
        var miurl = "{{route('bit_doc_enfermedades.bit_doc_enfermedade.cargaArchivo')}}";
        // var fileup=$("#file").val();
        var divresul = "texto_notificacion";

        var data = new FormData();
        data.append('file', $('#file')[0].files[0]);
        data.append('bitacora_enfermedade_id', $('#bitacora_enfermedade').val());
        data.append('documento', $('#descripcion').val());

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
                    url: "{{route('bit_doc_enfermedades.bit_doc_enfermedade.getFiles')}}",
                    dataType: "json",
                    data: "bitacora_enfermedade_id="+$(this).data('bitacora_enfermedade_id'),
                    success: function (anaVeri) {

                    var yenitablosatir2 = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
                    '<td colspan="12">' +
                    '<table class="table table-condensed altTablo table-hover" width=100% >' +
                    '<thead>' +
                            '<tr>' +
                            '<th>Consecutivo</th>' +
                            '<th>Documento</th>' +
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
                              '<td>' + anaVeri[i].documento + '</td>' +
                              '<td><a href="'+anaVeri[i].file_path +'" alt="' +anaVeri[i].file_name + '" target="_blank">' + anaVeri[i].file_name + '</a></td>' +
                              '<td>'+
                                '<form method="POST" action="' + '{!! url('bitacora_accidentes/bitacora_accidente/') !!}'+'/'+ anaVeri[i].id +'" accept-charset="UTF-8">'+
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
        
       
});

</script>
@endpush
