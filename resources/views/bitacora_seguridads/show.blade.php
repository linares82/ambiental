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
				<a href="{{ route('bitacora_seguridads.bitacora_seguridad.index') }}">{{ trans('bitacora_seguridads.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('bitacora_seguridads.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bitacora_seguridads.bitacora_seguridad.destroy', $bitacoraSeguridad->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bitacora_seguridads.bitacora_seguridad.index')
                    <a href="{{ route('bitacora_seguridads.bitacora_seguridad.index') }}" class="btn btn-primary" title="{{ trans('bitacora_seguridads.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_seguridads.bitacora_seguridad.create')
                    <a href="{{ route('bitacora_seguridads.bitacora_seguridad.create') }}" class="btn btn-success" title="{{ trans('bitacora_seguridads.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_seguridads.bitacora_seguridad.edit')
                    <a href="{{ route('bitacora_seguridads.bitacora_seguridad.edit', $bitacoraSeguridad->id ) }}" class="btn btn-primary" title="{{ trans('bitacora_seguridads.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_seguridads.bitacora_seguridad.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bitacora_seguridads.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_seguridads.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bitacora_seguridads.fecha') }}</dt>
            <dd>{{ $bitacoraSeguridad->fecha }}</dd>
            <dt>{{ trans('bitacora_seguridads.anio') }}</dt>
            <dd>{{ $bitacoraSeguridad->anio }}</dd>
            <dt>{{ trans('bitacora_seguridads.mes') }}</dt>
            <dd>{{ $bitacoraSeguridad->mes }}</dd>
            <dt>{{ trans('bitacora_seguridads.tpo_deteccion_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->csTpoDeteccion)->tpo_deteccion }}</dd>
            <dt>{{ trans('bitacora_seguridads.area_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->area)->area }}</dd>
            <dt>{{ trans('bitacora_seguridads.tpo_bitacora_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->csTpoBitacora)->tpo_bitacora }}</dd>
            <dt>{{ trans('bitacora_seguridads.tpo_inconformidad_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->csTpoInconformidade)->tpo_inconformidad }}</dd>
            <dt>{{ trans('bitacora_seguridads.inconformidad') }}</dt>
            <dd>{{ $bitacoraSeguridad->inconformidad }}</dd>
            <dt>{{ trans('bitacora_seguridads.solucion') }}</dt>
            <dd>{{ $bitacoraSeguridad->solucion }}</dd>
            <dt>{{ trans('bitacora_seguridads.grupo_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->csGrupoNorma)->grupo_norma }}</dd>
            <dt>{{ trans('bitacora_seguridads.norma_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->csNorma)->norma }}</dd>
            <dt>{{ trans('bitacora_seguridads.norma') }}</dt>
            <dd>{{ $bitacoraSeguridad->norma }}</dd>
            <dt>{{ trans('bitacora_seguridads.responsable_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('bitacora_seguridads.fec_planeada') }}</dt>
            <dd>{{ $bitacoraSeguridad->fec_planeada }}</dd>
            <dt>{{ trans('bitacora_seguridads.fec_solucion') }}</dt>
            <dd>{{ $bitacoraSeguridad->fec_solucion }}</dd>
            <dt>{{ trans('bitacora_seguridads.costo') }}</dt>
            <dd>{{ $bitacoraSeguridad->costo }}</dd>
            <dt>{{ trans('bitacora_seguridads.estatus_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->sStB)->id }}</dd>
            <dt>{{ trans('bitacora_seguridads.entity_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->entity)->rzon_social }}</dd>
            <dt>{{ trans('bitacora_seguridads.usu_alta_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->user)->name }}</dd>
            <dt>{{ trans('bitacora_seguridads.usu_mod_id') }}</dt>
            <dd>{{ optional($bitacoraSeguridad->user)->name }}</dd>
            <dt>{{ trans('bitacora_seguridads.created_at') }}</dt>
            <dd>{{ $bitacoraSeguridad->created_at }}</dd>
            <dt>{{ trans('bitacora_seguridads.updated_at') }}</dt>
            <dd>{{ $bitacoraSeguridad->updated_at }}</dd>
            
            <dt>{{ trans('bitacora_seguridads.dias_aviso') }}</dt>
            <dd>{{ $bitacoraSeguridad->dias_aviso }}</dd>

        </dl>

    </div>
</div>

@endsection