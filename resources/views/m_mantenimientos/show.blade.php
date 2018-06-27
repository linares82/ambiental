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
				<a href="{{ route('m_mantenimientos.m_mantenimiento.index') }}">{{ trans('m_mantenimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('m_mantenimientos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('m_mantenimientos.m_mantenimiento.destroy', $mMantenimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('m_mantenimientos.m_mantenimiento.index')
                    <a href="{{ route('m_mantenimientos.m_mantenimiento.index') }}" class="btn btn-primary" title="{{ trans('m_mantenimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_mantenimientos.m_mantenimiento.create')
                    <a href="{{ route('m_mantenimientos.m_mantenimiento.create') }}" class="btn btn-success" title="{{ trans('m_mantenimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_mantenimientos.m_mantenimiento.edit')
                    <a href="{{ route('m_mantenimientos.m_mantenimiento.edit', $mMantenimiento->id ) }}" class="btn btn-primary" title="{{ trans('m_mantenimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_mantenimientos.m_mantenimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('m_mantenimientos.delete') }}" onclick="return confirm(&quot;{{ trans('m_mantenimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('m_mantenimientos.no_orden') }}</dt>
            <dd>{{ $mMantenimiento->no_orden }}</dd>
            <dt>{{ trans('m_mantenimientos.codigo') }}</dt>
            <dd>{{ $mMantenimiento->codigo }}</dd>
            <dt>{{ trans('m_mantenimientos.m_tpo_manto_id') }}</dt>
            <dd>{{ optional($mMantenimiento->mTpoManto)->tpo_manto }}</dd>
            <dt>{{ trans('m_mantenimientos.objetivo_id') }}</dt>
            <dd>{{ optional($mMantenimiento->mObjetivo)->objetivo }}</dd>
            <dt>{{ trans('m_mantenimientos.subequipo_id') }}</dt>
            <dd>{{ optional($mMantenimiento->subequipo)->subequipo }}</dd>
            <dt>{{ trans('m_mantenimientos.solicitante_id') }}</dt>
            <dd>{{ optional($mMantenimiento->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('m_mantenimientos.fec_planeada') }}</dt>
            <dd>{{ $mMantenimiento->fec_planeada }}</dd>
            <dt>{{ trans('m_mantenimientos.aviso_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.dias_aviso') }}</dt>
            <dd>{{ $mMantenimiento->dias_aviso }}</dd>
            <dt>{{ trans('m_mantenimientos.fec_inicio') }}</dt>
            <dd>{{ $mMantenimiento->fec_inicio }}</dd>
            <dt>{{ trans('m_mantenimientos.descripcion') }}</dt>
            <dd>{{ $mMantenimiento->descripcion }}</dd>
            <dt>{{ trans('m_mantenimientos.lugar') }}</dt>
            <dd>{{ $mMantenimiento->lugar }}</dd>
            <dt>{{ trans('m_mantenimientos.ejecutor_id') }}</dt>
            <dd>{{ optional($mMantenimiento->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('m_mantenimientos.responsable_id') }}</dt>
            <dd>{{ optional($mMantenimiento->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('m_mantenimientos.recomendaciones') }}</dt>
            <dd>{{ $mMantenimiento->recomendaciones }}</dd>
            <dt>{{ trans('m_mantenimientos.materiales') }}</dt>
            <dd>{{ $mMantenimiento->materiales }}</dd>
            <dt>{{ trans('m_mantenimientos.horas_inv') }}</dt>
            <dd>{{ $mMantenimiento->horas_inv }}</dd>
            <dt>{{ trans('m_mantenimientos.costo') }}</dt>
            <dd>{{ $mMantenimiento->costo }}</dd>
            <dt>{{ trans('m_mantenimientos.tpp_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.riesgos') }}</dt>
            <dd>{{ $mMantenimiento->riesgos }}</dd>
            <dt>{{ trans('m_mantenimientos.supervision_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.conoce_procedimiento_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.lleva_equipo_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.cumple_puntos_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.estatus_id') }}</dt>
            <dd>{{ optional($mMantenimiento->mEstatus)->id }}</dd>
            <dt>{{ trans('m_mantenimientos.eventualidades_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.levantar_formato_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.registro_bitacora_bnd') }}</dt>
            <dd>{{ optional($mMantenimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('m_mantenimientos.accion') }}</dt>
            <dd>{{ $mMantenimiento->accion }}</dd>
            <dt>{{ trans('m_mantenimientos.resultado') }}</dt>
            <dd>{{ $mMantenimiento->resultado }}</dd>
            <dt>{{ trans('m_mantenimientos.fec_final') }}</dt>
            <dd>{{ $mMantenimiento->fec_final }}</dd>
            <dt>{{ trans('m_mantenimientos.observaciones') }}</dt>
            <dd>{{ $mMantenimiento->observaciones }}</dd>
            <dt>{{ trans('m_mantenimientos.entity_id') }}</dt>
            <dd>{{ optional($mMantenimiento->entity)->rzon_social }}</dd>
            <dt>{{ trans('m_mantenimientos.usu_alta_id') }}</dt>
            <dd>{{ optional($mMantenimiento->user)->name }}</dd>
            <dt>{{ trans('m_mantenimientos.usu_mod_id') }}</dt>
            <dd>{{ optional($mMantenimiento->user)->name }}</dd>
            <dt>{{ trans('m_mantenimientos.created_at') }}</dt>
            <dd>{{ $mMantenimiento->created_at }}</dd>
            <dt>{{ trans('m_mantenimientos.updated_at') }}</dt>
            <dd>{{ $mMantenimiento->updated_at }}</dd>
        </dl>

    </div>
</div>

@endsection