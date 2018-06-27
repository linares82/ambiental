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
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('enc_impactos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('enc_impactos.enc_impacto.destroy', $encImpacto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('enc_impactos.enc_impacto.index')
                    <a href="{{ route('enc_impactos.enc_impacto.index') }}" class="btn btn-primary" title="{{ trans('enc_impactos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('enc_impactos.enc_impacto.create')
                    <a href="{{ route('enc_impactos.enc_impacto.create') }}" class="btn btn-success" title="{{ trans('enc_impactos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('enc_impactos.enc_impacto.edit')
                    <a href="{{ route('enc_impactos.enc_impacto.edit', $encImpacto->id ) }}" class="btn btn-primary" title="{{ trans('enc_impactos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('enc_impactos.enc_impacto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('enc_impactos.delete') }}" onclick="return confirm(&quot;{{ trans('enc_impactos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('enc_impactos.cliente_id') }}</dt>
            <dt>{{ trans('enc_impactos.proyecto') }}</dt>
            <dd>{{ $encImpacto->proyecto }}</dd>
            <dt>{{ trans('enc_impactos.tipo_impacto_id') }}</dt>
            <dd>{{ optional($encImpacto->tipoImpacto)->tipo_impacto }}</dd>
            <dt>{{ trans('enc_impactos.fecha_inicio') }}</dt>
            <dd>{{ $encImpacto->fecha_inicio }}</dd>
            <dt>{{ trans('enc_impactos.fecha_fin') }}</dt>
            <dd>{{ $encImpacto->fecha_fin }}</dd>
            <dt>{{ trans('enc_impactos.up_calle') }}</dt>
            <dd>{{ $encImpacto->up_calle }}</dd>
            <dt>{{ trans('enc_impactos.up_no') }}</dt>
            <dd>{{ $encImpacto->up_no }}</dd>
            <dt>{{ trans('enc_impactos.up_colonia') }}</dt>
            <dd>{{ $encImpacto->up_colonia }}</dd>
            <dt>{{ trans('enc_impactos.up_cp') }}</dt>
            <dd>{{ $encImpacto->up_cp }}</dd>
            <dt>{{ trans('enc_impactos.up_delegacion') }}</dt>
            <dd>{{ $encImpacto->up_delegacion }}</dd>
            <dt>{{ trans('enc_impactos.up_sup_predio') }}</dt>
            <dd>{{ $encImpacto->up_sup_predio }}</dd>
            <dt>{{ trans('enc_impactos.longitud') }}</dt>
            <dd>{{ $encImpacto->longitud }}</dd>
            <dt>{{ trans('enc_impactos.latitud') }}</dt>
            <dd>{{ $encImpacto->latitud }}</dd>
            <dt>{{ trans('enc_impactos.altitud') }}</dt>
            <dd>{{ $encImpacto->altitud }}</dd>
            <dt>{{ trans('enc_impactos.utm_x') }}</dt>
            <dd>{{ $encImpacto->utm_x }}</dd>
            <dt>{{ trans('enc_impactos.utm_y') }}</dt>
            <dd>{{ $encImpacto->utm_y }}</dd>
            <dt>{{ trans('enc_impactos.notas') }}</dt>
            <dd>{{ $encImpacto->notas }}</dd>
            <dt>{{ trans('enc_impactos.cliente_id') }}</dt>
            <dd>{{ optional($encImpacto->cliente)->cliente }}</dd>
            <dt>{{ trans('enc_impactos.od_calle') }}</dt>
            <dd>{{ $encImpacto->od_calle }}</dd>
            <dt>{{ trans('enc_impactos.od_no') }}</dt>
            <dd>{{ $encImpacto->od_no }}</dd>
            <dt>{{ trans('enc_impactos.od_colonia') }}</dt>
            <dd>{{ $encImpacto->od_colonia }}</dd>
            <dt>{{ trans('enc_impactos.od_cp') }}</dt>
            <dd>{{ $encImpacto->od_cp }}</dd>
            <dt>{{ trans('enc_impactos.od_delegacion') }}</dt>
            <dd>{{ $encImpacto->od_delegacion }}</dd>
            <dt>{{ trans('enc_impactos.od_rfc') }}</dt>
            <dd>{{ $encImpacto->od_rfc }}</dd>
            <dt>{{ trans('enc_impactos.od_telefono') }}</dt>
            <dd>{{ $encImpacto->od_telefono }}</dd>
            <dt>{{ trans('enc_impactos.od_correo') }}</dt>
            <dd>{{ $encImpacto->od_correo }}</dd>
            <dt>{{ trans('enc_impactos.rl_ape_pat') }}</dt>
            <dd>{{ $encImpacto->rl_ape_pat }}</dd>
            <dt>{{ trans('enc_impactos.rl_ape_mat') }}</dt>
            <dd>{{ $encImpacto->rl_ape_mat }}</dd>
            <dt>{{ trans('enc_impactos.rl_nombre') }}</dt>
            <dd>{{ $encImpacto->rl_nombre }}</dd>
            <dt>{{ trans('enc_impactos.rl_id_vigente') }}</dt>
            <dd>{{ $encImpacto->rl_id_vigente }}</dd>
            <dt>{{ trans('enc_impactos.rl_id_no') }}</dt>
            <dd>{{ $encImpacto->rl_id_no }}</dd>
            <dt>{{ trans('enc_impactos.rl_no_intrumento') }}</dt>
            <dd>{{ $encImpacto->rl_no_intrumento }}</dd>
            <dt>{{ trans('enc_impactos.rl_autorizados') }}</dt>
            <dd>{{ $encImpacto->rl_autorizados }}</dd>
            <dt>{{ trans('enc_impactos.usu_alta_id') }}</dt>
            <dd>{{ optional($encImpacto->user)->name }}</dd>
            <dt>{{ trans('enc_impactos.usu_mod_id') }}</dt>
            <dd>{{ optional($encImpacto->user)->name }}</dd>
            <dt>{{ trans('enc_impactos.created_at') }}</dt>
            <dd>{{ $encImpacto->created_at }}</dd>
            <dt>{{ trans('enc_impactos.updated_at') }}</dt>
            <dd>{{ $encImpacto->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection