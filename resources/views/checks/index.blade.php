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
            <a href="{{ route('checks.check.index') }}">{{ trans('checks.model_plural') }}</a>
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
            <h4 class="mt-5 mb-5">{{ trans('checks.model_plural') }}</h4>
        </div>

        @ifUserCan('checks.check.create')
        <div class="btn-group btn-group-sm pull-right" role="group">
            <a href="{{ route('checks.check.create') }}" class="btn btn-success btn-xs" title="{{ trans('checks.create') }}">
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
            <a href="{{ route('checks.check.index') }}" class="btn btn-xs" title="Refrescar">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($checks) == 0)
    <div class="panel-body text-center">
        <h4>{{ trans('checks.none_available') }}</h4>
    </div>
    @else
    <div class="panel-body panel-body-with-table">
        <div class="row" >
            <div class="col-md-12">
                <form method="GET" action="{{ route('checks.check.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="GET">
                    <div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
                        <label for="id" class="control-label">Id</label>
                        <input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
                        <label for="cliente" class="control-label">{{ trans('checks.cliente') }}</label>
                        <!--<div class="col-md-10">-->
                        <select class="form-control chosen" id="cliente" name="cliente_id">
                            <option value="" style="display: none;" {{ old('cliente_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('checks.cliente__placeholder') }}</option>
                            @foreach ($clientes as $key => $cliente)
                            <option value="{{ $key }}" {{ old('cliente') == $key ? 'selected' : '' }}>
                                    {{ $cliente }}
                        </option>
                        @endforeach
                    </select>

                    {!! $errors->first('cliente_id', '<p class="help-block">:message</p>') !!}
                    <!--</div>-->
                </div>

                <div class="form-group col-md-4 {{ $errors->has('a_check_id') ? 'has-error' : '' }}">
                    <label for="a_check_id" class="control-label">{{ trans('checks.a_check_id') }}</label>
                    <!--<div class="col-md-10">-->
                    <select class="form-control chosen " id="a_check_id" name="a_check_id">
                        <option value="" style="display: none;" {{ old('a_check_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('checks.a_check_id__placeholder') }}</option>
                        @foreach ($aChecks as $key => $aCheck)
                        <option value="{{ $key }}" {{ old('a_check_id') == $key ? 'selected' : '' }}>
                                {{ $aCheck }}
                    </option>
                    @endforeach
                </select>

                {!! $errors->first('a_check_id', '<p class="help-block">:message</p>') !!}
                <!--</div>-->
            </div>

            <div class="form-group col-md-4 {{ $errors->has('solicitud') ? 'has-error' : '' }}">
                <label for="solicitud" class="control-label">{{ trans('checks.solicitud') }}</label>
                <!--<div class="col-md-10">-->
                <input class="form-control input-sm " name="solicitud" type="text" id="solicitud" value="{{ old('solicitud') }}" minlength="1" maxlength="255" placeholder="{{ trans('checks.solicitud__placeholder') }}">
                {!! $errors->first('solicitud', '<p class="help-block">:message</p>') !!}
                <!--</div>-->
            </div>
            <div class="form-group col-md-4 {{ $errors->has('fec_apertura') ? 'has-error' : '' }}">
                <label for="fec_apertura" class="control-label">{{ trans('checks.fec_apertura') }}</label>
                <!--<div class="col-md-10">-->
                <input class="form-control input-sm date-picker" name="fec_apertura" type="text" id="fec_apertura" value="{{ old('fec_apertura') }}" placeholder="{{ trans('checks.fec_apertura__placeholder') }}">
                {!! $errors->first('fec_apertura', '<p class="help-block">:message</p>') !!}
                <!--</div>-->
            </div>

            <div class="form-group col-md-4 {{ $errors->has('fec_cierre') ? 'has-error' : '' }}">
                <label for="fec_cierre" class="control-label">{{ trans('checks.fec_cierre') }}</label>
                <!--<div class="col-md-10">-->
                <input class="form-control input-sm date-picker" name="fec_cierre" type="text" id="fec_cierre" value="{{ old('fec_cierre') }}" placeholder="{{ trans('checks.fec_cierre__placeholder') }}">
                {!! $errors->first('fec_cierre', '<p class="help-block">:message</p>') !!}
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
                <th>{{ trans('checks.id') }}</th>
                <th>Lineas</th>
                <th>{{ trans('checks.cliente') }}</th>
                <th>{{ trans('checks.a_check_id') }}</th>
                <th>{{ trans('checks.solicitud') }}</th>
                <th>{{ trans('checks.fec_apertura') }}</th>
                <th>{{ trans('checks.fec_cierre') }}</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($checks as $check)
            <tr>
                <td>{{ $check->id }}</td>
                <td>
                    <button class="btn btn-success btnVerLineas pull-right btn-xs" lang="mesaj" data-check="{{$check->id}}" data-href="formation_json_parents" style="margin-left:10px;" >
                        <span class="fa fa-eye" aria-hidden="true"></span> Ver
                    </button>

                </td>
                <td>{{ optional($check->cliente)->cliente }}</td>
                <td>{{ optional($check->aCheck)->area }}</td>
                <td>{{ $check->solicitud }}</td>
                <td>{{ $check->fec_apertura }}</td>
                <td>{{ $check->fec_cierre }}</td>

                <td>

                    <form method="POST" action="{!! route('checks.check.destroy', $check->id) !!}" accept-charset="UTF-8">
                        <input name="_method" value="DELETE" type="hidden">
                        {{ csrf_field() }}

                        <div class="btn-group btn-group-xs pull-right" role="group">
                            @ifUserCan('checks.check.show')
                            <a href="{{ route('checks.check.show', $check->id ) }}" class="btn btn-info btn-xs" title="{{ trans('checks.show') }}">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            @endif
                            @ifUserCan('checks.check.edit')
                            <a href="{{ route('checks.check.edit', $check->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('checks.edit') }}">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                            @endif
                            @ifUserCan('checks.check.destroy')
                            <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('checks.delete') }}" onclick="return confirm(&quot;{{ trans('checks.confirm_delete') }}& quot; )">
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
    {!! $checks->render() !!}
</div>

@endif

</div>
@endsection

@push('scripts')
<script>

    $(document).ready(function() {


    var $table = $('.tblEnc');
    $table.find('.btnVerLineas').on('click', function(e) {

// click button

    //e.preventDefault();
    var $btn = $(e.target), $tablosatir = $btn.closest('tr'), $tablosonrakisatir = $tablosatir.next('tr.expand-child');
    if ($btn.attr("lang") === "mesaj") {
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
    url: "{{route('check_ls.check_l.getByCheck')}}",
            dataType: "json",
            data: "check=" + $(this).data('check'),
            success: function (anaVeri) {

            var yenitablosatir = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
                    '<td colspan="12">' +
                    '<table class="table table-condensed altTablo table-hover" width=100% >' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Consecutivo</th>' +
                    '<th>Area</th>' +
                    '<th>Norma</th>' +
                    '<th>No Conformidad</th>' +
                    '<th>Requisito</th>' +
                    '<th>Cumplimiento</th>' +
                    '<th>Actualizado</th>' +
                    '<th></th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
            //if (anaVeri.kullanici) {
            if (anaVeri) {
            //$.each(anaVeri.kullanici, function(i, kullaniciTomar) {

            var j = 1;
            $.each(anaVeri, function(i) {
            var btnEditarLn = "";
            @ifUserCan('ln_impactos.ln_impacto.edit')
                    btnEditarLn = '<button type="button" class="btn btn-xs btn-primary btnEditLinea" data-linea=' + anaVeri[i].id + '>' +
                    '<i class="glyphicon glyphicon-pencil"></i> Editar' +
                    '</button>'
                    @endif
                    var btnEliminarLn = "";
            @ifUserCan('ln_impactos.ln_impacto.destroy')
                    btnEliminarLn = '<button type="submit" class="btn btn-danger btn-xs" title="Eliminar" onclick="return confirm(&quot; Eliminar &quot;)">' +
                    '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Eliminar' +
                    '</button>';
            @endif
                    yenitablosatir += '<tr>' +
                    //kullaniciTomar.Surname      
                    '<td>' + j + '</td>' +
                    '<td>' + anaVeri[i].area + '</td>' +
                    '<td>' + anaVeri[i].norma + '</td>' +
                    '<td>' + anaVeri[i].no_conformidad + '</td>' +
                    '<td>' + anaVeri[i].requisito + '</td>' +
                    '<td>' + anaVeri[i].cumplimiento + '</td>' +
                    '<td>' + anaVeri[i].updated_at + '</td>' +
                    '<td>' +
                    '<form method="POST" action="' + '{!! url('check_ls / check_l / ') !!}' + '/' + anaVeri[i].id + '" accept-charset="UTF-8">' +
                    '<input name="_method" value="DELETE" type="hidden">' +
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
            window.open('{{url("/check_ls/edit/")}}' + '/' + $(this).data('linea'), '_blank');
            });
            }
    });
    }



    } // if click mesaj buton!



    if ($btn.attr("lang") === "yorum") {
    //////// yorum butonuna tıklandığında olan olaylar. (if clicked command buton)
    $table.find('.btnVerLineas').trigger('click');
    }

    }); // on click .btnVerLineas end


    });

</script>
@endpush