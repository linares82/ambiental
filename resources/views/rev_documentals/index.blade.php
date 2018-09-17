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
				<a href="{{ route('rev_documentals.rev_documental.index') }}">{{ trans('rev_documentals.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('rev_documentals.model_plural') }}</h4>
            </div>
            
            @ifUserCan('rev_documentals.rev_documental.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('rev_documentals.rev_documental.create') }}" class="btn btn-success btn-xs" title="{{ trans('rev_documentals.create') }}">
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
                <a href="{{ route('rev_documentals.rev_documental.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($revDocumentals) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('rev_documentals.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('rev_documentals.rev_documental.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('anio') ? 'has-error' : '' }}">
                                                    <label for="anio" class="control-label">{{ trans('rev_documentals.anio') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="anio" type="number" id="anio" value="{{ old('anio') }}" min="-2147483648" max="2147483647" placeholder="{{ trans('rev_documentals.anio__placeholder') }}">
                                                        {!! $errors->first('anio', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('mes_id') ? 'has-error' : '' }}">
                                                    <label for="mes_id" class="control-label">{{ trans('rev_documentals.mes_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="mes_id" name="mes_id">
                                                                    <option value="" style="display: none;" {{ old('mes_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_documentals.mes_id__placeholder') }}</option>
                                                                @foreach ($mese as $key => $mese)
                                                                            <option value="{{ $key }}" {{ old('mes_id') == $key ? 'selected' : '' }}>
                                                                                {{ $mese }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('mes_id', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('rev_documentals.entity_id') }}</th>
                            <th>Lineas</th>
                            <th>{{ trans('rev_documentals.anio') }}</th>
                            <th>{{ trans('rev_documentals.mes_id') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($revDocumentals as $revDocumental)
                        <tr>
                            <td>{{ $revDocumental->id }}</td>
                            <td>{{ $revDocumental->entity->abreviatura }}</td>
                            <td>
                                @ifUserCan('rev_documental_lns.rev_documental_ln.create')
                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="{{ route('rev_documental_lns.rev_documental_ln.create') }}" class="btn btn-success btn-xs" title="{{ trans('rev_documental_lns.create') }}">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                </div>
                                @endif
                                <button class="btn btn-success btnVerLineas pull-right btn-xs" lang="mesaj" data-rev_documental="{{$revDocumental->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                                    <span class="fa fa-eye" aria-hidden="true"></span> Ver
                                </button>
                                
                            </td>
                            <td>{{ $revDocumental->anio }}</td>
                            <td>{{ optional($revDocumental->mese)->mes }}</td>
                            
                            <td>

                                <form method="POST" action="{!! route('rev_documentals.rev_documental.destroy', $revDocumental->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('rev_documentals.rev_documental.show')
                                        <a href="{{ route('rev_documentals.rev_documental.show', $revDocumental->id ) }}" class="btn btn-info btn-xs" title="{{ trans('rev_documentals.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('rev_documentals.rev_documental.edit')
                                        <a href="{{ route('rev_documentals.rev_documental.edit', $revDocumental->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('rev_documentals.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('rev_documentals.rev_documental.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('rev_documentals.delete') }}" onclick="return confirm(&quot;{{ trans('rev_documentals.confirm_delete') }}&quot;)">
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
            {!! $revDocumentals->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection

@push('scripts')
<script>
  
$('.show-details-btn').on('click', function(e) {
        e.preventDefault();
        $(this).closest('tr').next().toggleClass('open');
        $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
});

$(document).ready(function() {


var $table = $('.tblEnc');



$table.find('.btnVerLineas').on('click', function(e) {

// click button

		//e.preventDefault();
		var $btn = $(e.target), $tablosatir = $btn.closest('tr'), $tablosonrakisatir = $tablosatir.next('tr.expand-child');
		
		if ( $btn.attr("lang") === "mesaj" ) {
///////////// mesajlar butonuna tıklandığında olan olaylar.
		
                if ($tablosonrakisatir.css("display") === 'none') {
                // if panel close !
                $tablosonrakisatir.slideDown(100);
                } else {
                // if panel open !
                $tablosonrakisatir.slideUp(100);
                }

	        //$("#kullanicihebir").html($tablosatir.find("tr").length);	

		
		if ($tablosonrakisatir.length) {
	    // sonraki satır yok ise 	
	    	
		
		
		} else 
                {
		
		// sonraki satır var ise	
			$.ajax({
			url: "{{route('rev_documental_lns.rev_documental_ln.getByEnc')}}",
			dataType: "json",
			data: "rev_documental="+$(this).data('rev_documental'),
			success: function (anaVeri) {
                            
			var yenitablosatir = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
			'<td colspan="12">' +
			'<table class="table table-condensed altTablo table-hover" width=100% >' +
			'<thead>' +
				'<tr>' +
                                '<th>Consecutivo</th>' +
                                '<th>T. Documento</th>' +
				'<th>Documento</th>' +
				'<th>Archivo</th>' +
				'<th>Estatus</th>' +
				'<th>Dias Restantes</th>' +
                                '<th>Fec. Cumplimiento</th>' +
                                '<th>Dias Restantes</th>' +
                                '<th>Fec. Vencimiento</th>' +
                                '<th>Importancia</th>' +
                                '<th></th>' +
				'</tr>' +
			'</thead>' +
			'<tbody>';

				//if (anaVeri.kullanici) {
                                if (anaVeri) {
					//$.each(anaVeri.kullanici, function(i, kullaniciTomar) {
                                        
                                        var j=1;
                                        $.each(anaVeri, function(i) {
                                        var btnEditarLn="";
                                        @ifUserCan('rev_documental_lns.rev_documental_ln.edit')
                                            btnEditarLn='<button type="button" class="btn btn-xs btn-primary btnEditLinea" data-linea='+anaVeri[i].id+'>'+
                                                '<i class="glyphicon glyphicon-pencil"></i> Editar'+
                                            '</button>'
                                        @endif
                                        var btnEliminarLn="";
                                        @ifUserCan('rev_documental_lns.rev_documental_ln.destroy')
                                            btnEliminarLn='<button type="submit" class="btn btn-danger btn-xs" title="Eliminar" onclick="return confirm(&quot; Eliminar &quot;)">'+
                                            '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Eliminar'+
                                        '</button>';
                                        @endif
					yenitablosatir += '<tr>' +
                                          //kullaniciTomar.Surname      
                                          '<td>' + j + '</td>' +
					  '<td>' + anaVeri[i].tpo_doc + '</td>' +
					  '<td>' + anaVeri[i].documento + '</td>' +
					  '<td>' + anaVeri[i].archivo + '</td>' +
                                          '<td>' + anaVeri[i].estatus + '</td>' +
                                          '<td>' + anaVeri[i].dias1 + '</td>' +
                                          '<td>' + anaVeri[i].fec_cumplimiento + '</td>' +
                                          '<td>' + anaVeri[i].dias2 + '</td>' +
                                          '<td>' + anaVeri[i].fec_vencimiento + '</td>' +
                                          '<td>' + anaVeri[i].importancia + '</td>' +
                                          '<td>'+
                                            '<form method="POST" action="' + '{!! url('rev_documental_lns/rev_documental_ln/') !!}'+'/'+ anaVeri[i].id +'" accept-charset="UTF-8">'+
                                            '<input name="_method" value="DELETE" type="hidden">'+
                                            '{{ csrf_field() }}' +
                                            btnEditarLn +
                                            btnEliminarLn +
                                          '</td>' +
					  '</tr>';
                                        j++;
					});
				}
			yenitablosatir += '</tbody></table></td></tr>';
			// set next row
			$tablosonrakisatir = $(yenitablosatir).insertAfter($tablosatir);
			
                                $(".btnEditLinea").click(function(){
                                    //window.location = '{{url("/ln_impactos/edit/")}}'+'/'+$(this).data('linea');
                                    window.open('{{url("/rev_documental_lns/edit/")}}'+'/'+$(this).data('linea'), '_blank');
                                });
        
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