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
				<a href="{{ route('a_no_conformidades.a_no_conformidade.index') }}">{{ trans('a_no_conformidades.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('a_no_conformidades.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_no_conformidades.a_no_conformidade.destroy', $aNoConformidade->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_no_conformidades.a_no_conformidade.index')
                    <a href="{{ route('a_no_conformidades.a_no_conformidade.index') }}" class="btn btn-primary" title="{{ trans('a_no_conformidades.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_no_conformidades.a_no_conformidade.create')
                    <a href="{{ route('a_no_conformidades.a_no_conformidade.create') }}" class="btn btn-success" title="{{ trans('a_no_conformidades.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_no_conformidades.a_no_conformidade.edit')
                    <a href="{{ route('a_no_conformidades.a_no_conformidade.edit', $aNoConformidade->id ) }}" class="btn btn-primary" title="{{ trans('a_no_conformidades.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_no_conformidades.a_no_conformidade.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_no_conformidades.delete') }}" onclick="return confirm(&quot;{{ trans('a_no_conformidades.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_no_conformidades.no_conformidad') }}</dt>
            <dd>{{ $aNoConformidade->no_conformidad }}</dd>
            <dt>{{ trans('a_no_conformidades.fecha') }}</dt>
            <dd>{{ $aNoConformidade->fecha }}</dd>
            <dt>{{ trans('a_no_conformidades.anio') }}</dt>
            <dd>{{ $aNoConformidade->anio }}</dd>
            <dt>{{ trans('a_no_conformidades.mes') }}</dt>
            <dd>{{ $aNoConformidade->mes }}</dd>
            <dt>{{ trans('a_no_conformidades.area_id') }}</dt>
            <dd>{{ optional($aNoConformidade->area)->area }}</dd>
            <dt>{{ trans('a_no_conformidades.tpo_deteccion_id') }}</dt>
            <dd>{{ optional($aNoConformidade->csTpoDeteccion)->id }}</dd>
            <dt>{{ trans('a_no_conformidades.tpo_bitacora_id') }}</dt>
            <dd>{{ optional($aNoConformidade->caTpoBitacora)->tpo_bitacora }}</dd>
            <dt>{{ trans('a_no_conformidades.tpo_inconformidad_id') }}</dt>
            <dd>{{ optional($aNoConformidade->caTpoNoConformidad)->tpo_inconformidad }}</dd>
            <dt>{{ trans('a_no_conformidades.solucion') }}</dt>
            <dd>{{ $aNoConformidade->solucion }}</dd>
            <dt>{{ trans('a_no_conformidades.responsable_id') }}</dt>
            <dd>{{ optional($aNoConformidade->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('a_no_conformidades.fec_planeada') }}</dt>
            <dd>{{ $aNoConformidade->fec_planeada }}</dd>
            <dt>{{ trans('a_no_conformidades.fec_solucion') }}</dt>
            <dd>{{ $aNoConformidade->fec_solucion }}</dd>
            <dt>{{ trans('a_no_conformidades.costo') }}</dt>
            <dd>{{ $aNoConformidade->costo }}</dd>
            <dt>{{ trans('a_no_conformidades.estatus_id') }}</dt>
            <dd>{{ optional($aNoConformidade->aStNc)->id }}</dd>
            <dt>{{ trans('a_no_conformidades.entity_id') }}</dt>
            <dd>{{ optional($aNoConformidade->entity)->rzon_social }}</dd>
            <dt>{{ trans('a_no_conformidades.usu_alta_id') }}</dt>
            <dd>{{ optional($aNoConformidade->user)->name }}</dd>
            <dt>{{ trans('a_no_conformidades.usu_mod_id') }}</dt>
            <dd>{{ optional($aNoConformidade->user)->name }}</dd>
            <dt>{{ trans('a_no_conformidades.created_at') }}</dt>
            <dd>{{ $aNoConformidade->created_at }}</dd>
            <dt>{{ trans('a_no_conformidades.updated_at') }}</dt>
            <dd>{{ $aNoConformidade->updated_at }}</dd>
            <dt>{{ trans('a_no_conformidades.deleted_at') }}</dt>
            <dd>{{ $aNoConformidade->deleted_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection