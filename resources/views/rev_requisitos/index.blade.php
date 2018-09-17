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
				<a href="{{ route('rev_requisitos.rev_requisito.index') }}">{{ trans('rev_requisitos.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('rev_requisitos.model_plural') }}</h4>
            </div>
            
            @ifUserCan('rev_requisitos.rev_requisito.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('rev_requisitos.rev_requisito.create') }}" class="btn btn-success btn-xs" title="{{ trans('rev_requisitos.create') }}">
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
                <a href="{{ route('rev_requisitos.rev_requisito.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($revRequisitos) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('rev_requisitos.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('rev_requisitos.rev_requisito.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
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

                <table class="table table-striped table-bordered table-hover tblEnc" id="">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('rev_requisitos.entity_id') }}</th>
                            <th>Lineas</th>
                            <th>{{ trans('rev_requisitos.anio') }}</th>
                            <th>{{ trans('rev_requisitos.mes_id') }}</th>
                            

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($revRequisitos as $revRequisito)
                        <tr>
                            <td>{{ $revRequisito->id }}</td>
                            <td>{{ $revRequisito->entity->abreviatura }}</td>
                            <td>
                                @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.create')
                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.create') }}" class="btn btn-success btn-xs" title="{{ trans('rev_requisitos_lns.create') }}">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                </div>
                                @endif
                                <button class="btn btn-success btnVerLineas pull-right btn-xs" lang="mesaj" data-rev_requisito="{{$revRequisito->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                                    <span class="fa fa-eye" aria-hidden="true"></span> Ver
                                </button>
                                
                            </td>
                            <td>{{ $revRequisito->anio }}</td>
                            <td>{{ optional($revRequisito->meses)->mes }}</td>
                            
                            <td>

                                <form method="POST" action="{!! route('rev_requisitos.rev_requisito.destroy', $revRequisito->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('rev_requisitos.rev_requisito.show')
                                        <a href="{{ route('rev_requisitos.rev_requisito.show', $revRequisito->id ) }}" class="btn btn-info btn-xs" title="{{ trans('rev_requisitos.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('rev_requisitos.rev_requisito.edit')
                                        <a href="{{ route('rev_requisitos.rev_requisito.edit', $revRequisito->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('rev_requisitos.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('rev_requisitos.rev_requisito.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('rev_requisitos.delete') }}" onclick="return confirm(&quot;{{ trans('rev_requisitos.confirm_delete') }}&quot;)">
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
            {!! $revRequisitos->render() !!}
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
			url: "{{route('rev_requisitos_lns.rev_requisitos_ln.getByEnc')}}",
			dataType: "json",
			data: "rev_requisito="+$(this).data('rev_requisito'),
			success: function (anaVeri) {
                            
			var yenitablosatir = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
			'<td colspan="12">' +
			'<table class="table table-condensed altTablo table-hover" width=100% >' +
			'<thead>' +
				'<tr>' +
                                '<th>Consecutivo</th>' +
				'<th>Impacto</th>' +
				'<th>Condicion</th>' +
				'<th>Estatus</th>' +
				'<th>Dias Restantes</th>' +
                                '<th>Fec. Cumplimiento</th>' +
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
                                        @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.edit')
                                            btnEditarLn='<button type="button" id="btnEditLinea" class="btn btn-xs btn-primary" data-linea='+anaVeri[i].id+'>'+
                                                '<i class="glyphicon glyphicon-pencil"></i> Editar'+
                                            '</button>'
                                        @endif
                                        var btnEliminarLn="";
                                        @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.destroy')
                                            btnEliminarLn='<button type="submit" class="btn btn-danger btn-xs" title="Eliminar" onclick="return confirm(&quot; Eliminar &quot;)">'+
                                            '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Eliminar'+
                                        '</button>';
                                        @endif
					yenitablosatir += '<tr>' +
                                          //kullaniciTomar.Surname      
                                          '<td>' + j + '</td>' +
					  '<td>' + anaVeri[i].impacto + '</td>' +
					  '<td>' + anaVeri[i].condicion + '</td>' +
					  '<td>' + anaVeri[i].estatus + '</td>' +
                                          '<td>' + "" + '</td>' +
                                          '<td>' + anaVeri[i].fec_cumplimiento + '</td>' +
                                          '<td>' + anaVeri[i].importancia + '</td>' +
                                          '<td>'+
                                            '<form method="POST" action="' + '{!! url('rev_requisitos_lns/rev_requisitos_ln/') !!}'+'/'+ anaVeri[i].id +'" accept-charset="UTF-8">'+
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
			
                                $("#btnEditLinea").click(function(){
                                    //window.location = '{{url("/ln_impactos/edit/")}}'+'/'+$(this).data('linea');
                                    window.open('{{url("/rev_requisitos_lns/edit/")}}'+'/'+$(this).data('linea'), '_blank');
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