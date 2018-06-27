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
				<a href="{{ route('bitacora_consumibles.bitacora_consumible.index') }}">{{ trans('bitacora_consumibles.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('bitacora_consumibles.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bitacora_consumibles.bitacora_consumible.destroy', $bitacoraConsumible->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bitacora_consumibles.bitacora_consumible.index')
                    <a href="{{ route('bitacora_consumibles.bitacora_consumible.index') }}" class="btn btn-primary" title="{{ trans('bitacora_consumibles.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_consumibles.bitacora_consumible.create')
                    <a href="{{ route('bitacora_consumibles.bitacora_consumible.create') }}" class="btn btn-success" title="{{ trans('bitacora_consumibles.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_consumibles.bitacora_consumible.edit')
                    <a href="{{ route('bitacora_consumibles.bitacora_consumible.edit', $bitacoraConsumible->id ) }}" class="btn btn-primary" title="{{ trans('bitacora_consumibles.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_consumibles.bitacora_consumible.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bitacora_consumibles.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_consumibles.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bitacora_consumibles.consumible_id') }}</dt>
            <dd>{{ optional($bitacoraConsumible->caConsumible)->consumible }}</dd>
            <dt>{{ trans('bitacora_consumibles.consumo') }}</dt>
            <dd>{{ $bitacoraConsumible->consumo }}</dd>
            <dt>{{ trans('bitacora_consumibles.fecha') }}</dt>
            <dd>{{ $bitacoraConsumible->fecha }}</dd>
            <dt>{{ trans('bitacora_consumibles.anio') }}</dt>
            <dd>{{ $bitacoraConsumible->anio }}</dd>
            <dt>{{ trans('bitacora_consumibles.mes') }}</dt>
            <dd>{{ $bitacoraConsumible->mes }}</dd>
            <dt>{{ trans('bitacora_consumibles.costo') }}</dt>
            <dd>{{ $bitacoraConsumible->costo }}</dd>
            <dt>{{ trans('bitacora_consumibles.fec_inicio') }}</dt>
            <dd>{{ $bitacoraConsumible->fec_inicio }}</dd>
            <dt>{{ trans('bitacora_consumibles.fec_fin') }}</dt>
            <dd>{{ $bitacoraConsumible->fec_fin }}</dd>
            <dt>{{ trans('bitacora_consumibles.factor_indicador') }}</dt>
            <dd>{{ $bitacoraConsumible->factor_indicador }}</dd>
            <dt>{{ trans('bitacora_consumibles.factor_calculado') }}</dt>
            <dd>{{ $bitacoraConsumible->factor_calculado }}</dd>
            <dt>{{ trans('bitacora_consumibles.entity_id') }}</dt>
            <dd>{{ optional($bitacoraConsumible->entity)->rzon_social }}</dd>
            <dt>{{ trans('bitacora_consumibles.usu_alta_id') }}</dt>
            <dd>{{ optional($bitacoraConsumible->user)->name }}</dd>
            <dt>{{ trans('bitacora_consumibles.usu_mod_id') }}</dt>
            <dd>{{ optional($bitacoraConsumible->user)->name }}</dd>
            <dt>{{ trans('bitacora_consumibles.created_at') }}</dt>
            <dd>{{ $bitacoraConsumible->created_at }}</dd>
            <dt>{{ trans('bitacora_consumibles.updated_at') }}</dt>
            <dd>{{ $bitacoraConsumible->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection