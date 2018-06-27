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
				<a href="{{ route('bitacora_residuos.bitacora_residuo.index') }}">{{ trans('bitacora_residuos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('bitacora_residuos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bitacora_residuos.bitacora_residuo.destroy', $bitacoraResiduo->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bitacora_residuos.bitacora_residuo.index')
                    <a href="{{ route('bitacora_residuos.bitacora_residuo.index') }}" class="btn btn-primary" title="{{ trans('bitacora_residuos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_residuos.bitacora_residuo.create')
                    <a href="{{ route('bitacora_residuos.bitacora_residuo.create') }}" class="btn btn-success" title="{{ trans('bitacora_residuos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_residuos.bitacora_residuo.edit')
                    <a href="{{ route('bitacora_residuos.bitacora_residuo.edit', $bitacoraResiduo->id ) }}" class="btn btn-primary" title="{{ trans('bitacora_residuos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_residuos.bitacora_residuo.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bitacora_residuos.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_residuos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bitacora_residuos.residuo') }}</dt>
            <dd>{{ optional($bitacoraResiduo->caResiduo)->residuo }}</dd>
            <dt>{{ trans('bitacora_residuos.cantidad') }}</dt>
            <dd>{{ $bitacoraResiduo->cantidad }}</dd>
            <dt>{{ trans('bitacora_residuos.fecha') }}</dt>
            <dd>{{ $bitacoraResiduo->fecha }}</dd>
            <dt>{{ trans('bitacora_residuos.anio') }}</dt>
            <dd>{{ $bitacoraResiduo->anio }}</dd>
            <dt>{{ trans('bitacora_residuos.mes') }}</dt>
            <dd>{{ $bitacoraResiduo->mes }}</dd>
            <dt>{{ trans('bitacora_residuos.lugar_generacion') }}</dt>
            <dd>{{ $bitacoraResiduo->lugar_generacion }}</dd>
            <dt>{{ trans('bitacora_residuos.ubicacion') }}</dt>
            <dd>{{ $bitacoraResiduo->ubicacion }}</dd>
            <dt>{{ trans('bitacora_residuos.dispocision') }}</dt>
            <dd>{{ $bitacoraResiduo->dispocision }}</dd>
            <dt>{{ trans('bitacora_residuos.transportista') }}</dt>
            <dd>{{ $bitacoraResiduo->transportista }}</dd>
            <dt>{{ trans('bitacora_residuos.manifiesto') }}</dt>
            <dd>{{ $bitacoraResiduo->manifiesto }}</dd>
            <dt>{{ trans('bitacora_residuos.resp_tecnico') }}</dt>
            <dd>{{ $bitacoraResiduo->resp_tecnico }}</dd>
            <dt>{{ trans('bitacora_residuos.requiere_vobo') }}</dt>
            <dd>{{ optional($bitacoraResiduo->bnd)->bnd }}</dd>
            <dt>{{ trans('bitacora_residuos.registro_residuos') }}</dt>
            <dd>{{ optional($bitacoraResiduo->bnd)->bnd }}</dd>
            <dt>{{ trans('bitacora_residuos.peligrosidad') }}</dt>
            <dd>{{ $bitacoraResiduo->peligrosidad }}</dd>
            <dt>{{ trans('bitacora_residuos.fec_ingreso') }}</dt>
            <dd>{{ $bitacoraResiduo->fec_ingreso }}</dd>
            <dt>{{ trans('bitacora_residuos.cedula_operacion') }}</dt>
            <dd>{{ optional($bitacoraResiduo->bnd)->bnd }}</dd>
            <dt>{{ trans('bitacora_residuos.factor_indicador') }}</dt>
            <dd>{{ $bitacoraResiduo->factor_indicador }}</dd>
            <dt>{{ trans('bitacora_residuos.factor_calculado') }}</dt>
            <dd>{{ $bitacoraResiduo->factor_calculado }}</dd>
            <dt>{{ trans('bitacora_residuos.responsable_id') }}</dt>
            <dd>{{ optional($bitacoraResiduo->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('bitacora_residuos.entity_id') }}</dt>
            <dd>{{ optional($bitacoraResiduo->entity)->rzon_social }}</dd>
            <dt>{{ trans('bitacora_residuos.usu_alta_id') }}</dt>
            <dd>{{ optional($bitacoraResiduo->user)->name }}</dd>
            <dt>{{ trans('bitacora_residuos.usu_mod_id') }}</dt>
            <dd>{{ optional($bitacoraResiduo->user)->name }}</dd>
            <dt>{{ trans('bitacora_residuos.created_at') }}</dt>
            <dd>{{ $bitacoraResiduo->created_at }}</dd>
            <dt>{{ trans('bitacora_residuos.updated_at') }}</dt>
            <dd>{{ $bitacoraResiduo->updated_at }}</dd>
            <dt>{{ trans('bitacora_residuos.fec_salida') }}</dt>
            <dd>{{ $bitacoraResiduo->fec_salida }}</dd>

        </dl>

    </div>
</div>

@endsection