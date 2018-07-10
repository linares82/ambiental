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
            <a href="{{ route('enc_impactos.enc_impacto.index') }}">{{ trans('enc_impactos.model_plural') }}</a>
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
            <h4 class="mt-5 mb-5">{{ trans('enc_impactos.model_plural') }}</h4>
        </div>

        @ifUserCan('enc_impactos.enc_impacto.create')
        <div class="btn-group btn-group-sm pull-right" role="group">
            <a href="{{ route('enc_impactos.enc_impacto.create') }}" class="btn btn-success btn-xs" title="{{ trans('enc_impactos.create') }}">
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
            <a href="{{ route('enc_impactos.enc_impacto.index') }}" class="btn btn-xs" title="Refrescar">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($encImpactos) == 0)
    <div class="panel-body text-center">
        <h4>{{ trans('enc_impactos.none_available') }}</h4>
    </div>
    @else
    <div class="panel-body panel-body-with-table">
        <div class="row" >
            <div class="col-md-12">
                <form method="GET" action="{{ route('enc_impactos.enc_impacto.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="GET">
                    <div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
                        <label for="id" class="control-label">Id</label>
                        <input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
                        <label for="cliente_id" class="control-label">{{ trans('enc_impactos.cliente_id') }}</label>
                        <!--<div class="col-md-10">-->
                            <select class="form-control chosen" id="cliente_id" name="cliente_id">
                                        <option value="" style="display: none;" {{ old('cliente_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('enc_impactos.cliente_id__placeholder') }}</option>
                                    @foreach ($clientes as $key => $cliente)
                                                <option value="{{ $key }}" {{ old('cliente_id') == $key ? 'selected' : '' }}>
                                                    {{ $cliente }}
                                                </option>
                                            @endforeach
                            </select>

                            {!! $errors->first('cliente_id', '<p class="help-block">:message</p>') !!}
                        <!--</div>-->
                    </div>


                    <div class="form-group col-md-4 {{ $errors->has('tipo_impacto_id') ? 'has-error' : '' }}">
                        <label for="tipo_impacto_id" class="control-label">{{ trans('enc_impactos.tipo_impacto_id') }}</label>
                        <!--<div class="col-md-10">-->
                            <select class="form-control chosen" id="tipo_impacto_id" name="tipo_impacto_id">
                                        <option value="" style="display: none;" {{ old('tipo_impacto_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('enc_impactos.tipo_impacto_id__placeholder') }}</option>
                                    @foreach ($tipoImpactos as $key => $tipoImpacto)
                                                <option value="{{ $key }}" {{ old('tipo_impacto_id') == $key ? 'selected' : '' }}>
                                                    {{ $tipoImpacto }}
                                                </option>
                                            @endforeach
                            </select>

                            {!! $errors->first('tipo_impacto_id', '<p class="help-block">:message</p>') !!}
                        <!--</div>-->
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('fecha_inicio') ? 'has-error' : '' }}" style="clear:left;">
                        <label for="fecha_inicio" class="control-label">{{ trans('enc_impactos.fecha_inicio') }}</label>
                        <!--<div class="col-md-10">-->
                            <input class="form-control input-sm date-picker" name="fecha_inicio" type="text" id="fecha_inicio" value="{{ old('fecha_inicio') }}" placeholder="{{ trans('enc_impactos.fecha_inicio__placeholder') }}">
                            {!! $errors->first('fecha_inicio', '<p class="help-block">:message</p>') !!}
                        <!--</div>-->
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('fecha_fin') ? 'has-error' : '' }}">
                        <label for="fecha_fin" class="control-label">{{ trans('enc_impactos.fecha_fin') }}</label>
                        <!--<div class="col-md-10">-->
                            <input class="form-control input-sm date-picker" name="fecha_fin" type="text" id="fecha_fin" value="{{ old('fecha_fin') }}" placeholder="{{ trans('enc_impactos.fecha_fin__placeholder') }}">
                            {!! $errors->first('fecha_fin', '<p class="help-block">:message</p>') !!}
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
                        <th>{{ trans('enc_impactos.id') }}</th>
                        <th>Lineas</th>
                        <th>{{ trans('enc_impactos.cliente_id') }}</th>
                        <th>{{ trans('enc_impactos.tipo_impacto_id') }}</th>
                        <th>{{ trans('enc_impactos.fecha_inicio') }}</th>
                        <th>{{ trans('enc_impactos.fecha_fin') }}</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($encImpactos as $encImpacto)
                    <tr>
                        <td>{{ $encImpacto->id }}</td>
                        <td>                                
<!--                            <div class="action-buttons">
                                <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                    <i class="ace-icon fa fa-angle-double-down"></i>
                                    <span class="sr-only">Details</span>
                                </a>
                            </div>-->
                            <button class="btn btn-success btnVerLineas pull-right btn-xs" lang="mesaj" data-enc_impacto="{{$encImpacto->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                                <span class="fa fa-eye" aria-hidden="true"></span> Ver
                            </button>
                        </td>
                        <td>{{ optional($encImpacto->cliente)->cliente }}</td>
                        <td>{{ optional($encImpacto->tipoImpacto)->tipo_impacto }}</td>
                        <td>{{ $encImpacto->fecha_inicio }}</td>
                        <td>{{ $encImpacto->fecha_fin }}</td>

                        <td>

                            <form method="POST" action="{!! route('enc_impactos.enc_impacto.destroy', $encImpacto->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    @ifUserCan('enc_impactos.enc_impacto.show')
                                    <a href="{{ route('enc_impactos.enc_impacto.show', $encImpacto->id ) }}" class="btn btn-info btn-xs" title="{{ trans('enc_impactos.show') }}">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </a>
                                    @endif
                                    @ifUserCan('enc_impactos.enc_impacto.edit')
                                    <a href="{{ route('enc_impactos.enc_impacto.edit', $encImpacto->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('enc_impactos.edit') }}">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                    @endif
                                    @ifUserCan('enc_impactos.enc_impacto.destroy')
                                    <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('enc_impactos.delete') }}" onclick="return confirm(&quot;{{ trans('enc_impactos.confirm_delete') }}& quot; )">
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
        {!! $encImpactos->render() !!}
    </div>

    @endif

</div>
@endsection

@push('scripts')
<script>

$('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
            $(this).prev().focus();
    });

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
			url: "{{route('ln_impactos.ln_impacto.getByEnc')}}",
			dataType: "json",
			data: "enc_impacto="+$(this).data('enc_impacto'),
			success: function (anaVeri) {
                            
			var yenitablosatir = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
			'<td colspan="12">' +
			'<table class="table table-condensed altTablo table-hover" width=100% >' +
			'<thead>' +
				'<tr>' +
                                '<th>Consecutivo</th>' +
				'<th>Factor</th>' +
				'<th>Rubro</th>' +
				'<th>Especifico</th>' +
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
                                        var btnEditarLn="";
                                        @ifUserCan('ln_impactos.ln_impacto.edit')
                                            btnEditarLn='<button type="button" class="btn btn-xs btn-primary btnEditLinea" data-linea='+anaVeri[i].id+'>'+
                                                '<i class="glyphicon glyphicon-pencil"></i> Editar'+
                                            '</button>'
                                        @endif
                                        var btnEliminarLn="";
                                        @ifUserCan('ln_impactos.ln_impacto.destroy')
                                            btnEliminarLn='<button type="submit" class="btn btn-danger btn-xs" title="Eliminar" onclick="return confirm(&quot; Eliminar &quot;)">'+
                                            '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Eliminar'+
                                        '</button>';
                                        @endif
					yenitablosatir += '<tr>' +
                                          //kullaniciTomar.Surname      
                                          '<td>' + j + '</td>' +
					  '<td>' + anaVeri[i].factor + '</td>' +
					  '<td>' + anaVeri[i].rubro + '</td>' +
					  '<td>' + anaVeri[i].especifico + '</td>' +
                                          '<td>' + anaVeri[i].estatus + '</td>' +
                                          '<td>'+
                                            '<form method="POST" action="' + '{!! url('ln_impactos/ln_impacto/') !!}'+'/'+ anaVeri[i].id +'" accept-charset="UTF-8">'+
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
                                    window.open('{{url("/ln_impactos/edit/")}}'+'/'+$(this).data('linea'), '_blank');
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
