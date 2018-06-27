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
				<a href="{{ route('bitacora_plantas.bitacora_planta.index') }}">{{ trans('bitacora_plantas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('bitacora_plantas.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bitacora_plantas.bitacora_planta.destroy', $bitacoraPlanta->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bitacora_plantas.bitacora_planta.index')
                    <a href="{{ route('bitacora_plantas.bitacora_planta.index') }}" class="btn btn-primary" title="{{ trans('bitacora_plantas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_plantas.bitacora_planta.create')
                    <a href="{{ route('bitacora_plantas.bitacora_planta.create') }}" class="btn btn-success" title="{{ trans('bitacora_plantas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_plantas.bitacora_planta.edit')
                    <a href="{{ route('bitacora_plantas.bitacora_planta.edit', $bitacoraPlanta->id ) }}" class="btn btn-primary" title="{{ trans('bitacora_plantas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_plantas.bitacora_planta.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bitacora_plantas.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_plantas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bitacora_plantas.planta_id') }}</dt>
            <dd>{{ optional($bitacoraPlanta->caPlanta)->planta }}</dd>
            <dt>{{ trans('bitacora_plantas.fecha') }}</dt>
            <dd>{{ $bitacoraPlanta->fecha }}</dd>
            <dt>{{ trans('bitacora_plantas.anio') }}</dt>
            <dd>{{ $bitacoraPlanta->anio }}</dd>
            <dt>{{ trans('bitacora_plantas.mes') }}</dt>
            <dd>{{ $bitacoraPlanta->mes }}</dd>
            <dt>{{ trans('bitacora_plantas.turno_id') }}</dt>
            <dd>{{ optional($bitacoraPlanta->turno)->turno }}</dd>
            <dt>{{ trans('bitacora_plantas.agua_entrada') }}</dt>
            <dd>{{ $bitacoraPlanta->agua_entrada }}</dd>
            <dt>{{ trans('bitacora_plantas.agua_salida') }}</dt>
            <dd>{{ $bitacoraPlanta->agua_salida }}</dd>
            <dt>{{ trans('bitacora_plantas.q_usados') }}</dt>
            <dd>{{ $bitacoraPlanta->q_usados }}</dd>
            <dt>{{ trans('bitacora_plantas.q_existentes') }}</dt>
            <dd>{{ $bitacoraPlanta->q_existentes }}</dd>
            <dt>{{ trans('bitacora_plantas.tiempo_operacion') }}</dt>
            <dd>{{ $bitacoraPlanta->tiempo_operacion }}</dd>
            <dt>{{ trans('bitacora_plantas.motivo_paro') }}</dt>
            <dd>{{ $bitacoraPlanta->motivo_paro }}</dd>
            <dt>{{ trans('bitacora_plantas.vol_lodos') }}</dt>
            <dd>{{ $bitacoraPlanta->vol_lodos }}</dd>
            <dt>{{ trans('bitacora_plantas.disp_lodos') }}</dt>
            <dd>{{ $bitacoraPlanta->disp_lodos }}</dd>
            <dt>{{ trans('bitacora_plantas.fec_ult_manto') }}</dt>
            <dd>{{ $bitacoraPlanta->fec_ult_manto }}</dd>
            <dt>{{ trans('bitacora_plantas.desc_manto') }}</dt>
            <dd>{{ $bitacoraPlanta->desc_manto }}</dd>
            <dt>{{ trans('bitacora_plantas.obs') }}</dt>
            <dd>{{ $bitacoraPlanta->obs }}</dd>
            <dt>{{ trans('bitacora_plantas.responsable_id') }}</dt>
            <dd>{{ optional($bitacoraPlanta->empleado)->nombre }}</dd>
            <dt>{{ trans('bitacora_plantas.entity_id') }}</dt>
            <dd>{{ optional($bitacoraPlanta->entity)->rzon_social }}</dd>
            <dt>{{ trans('bitacora_plantas.usu_alta_id') }}</dt>
            <dd>{{ optional($bitacoraPlanta->user)->name }}</dd>
            <dt>{{ trans('bitacora_plantas.usu_mod_id') }}</dt>
            <dd>{{ optional($bitacoraPlanta->user)->name }}</dd>
            <dt>{{ trans('bitacora_plantas.created_at') }}</dt>
            <dd>{{ $bitacoraPlanta->created_at }}</dd>
            <dt>{{ trans('bitacora_plantas.updated_at') }}</dt>
            <dd>{{ $bitacoraPlanta->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection