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
				<a href="{{ route('bitacora_accidentes.bitacora_accidente.index') }}">{{ trans('bitacora_accidentes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('bitacora_accidentes.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bitacora_accidentes.bitacora_accidente.destroy', $bitacoraAccidente->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bitacora_accidentes.bitacora_accidente.index')
                    <a href="{{ route('bitacora_accidentes.bitacora_accidente.index') }}" class="btn btn-primary" title="{{ trans('bitacora_accidentes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_accidentes.bitacora_accidente.create')
                    <a href="{{ route('bitacora_accidentes.bitacora_accidente.create') }}" class="btn btn-success" title="{{ trans('bitacora_accidentes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_accidentes.bitacora_accidente.edit')
                    <a href="{{ route('bitacora_accidentes.bitacora_accidente.edit', $bitacoraAccidente->id ) }}" class="btn btn-primary" title="{{ trans('bitacora_accidentes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_accidentes.bitacora_accidente.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bitacora_accidentes.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_accidentes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bitacora_accidentes.area_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->area)->area }}</dd>
            <dt>{{ trans('bitacora_accidentes.responsable_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->empleado)->nombre }}</dd>
            <dt>{{ trans('bitacora_accidentes.persona_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->empleado)->nombre }}</dd>
            <dt>{{ trans('bitacora_accidentes.accidente_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->csAccidente)->accidente }}</dd>
            <dt>{{ trans('bitacora_accidentes.descripcion') }}</dt>
            <dd>{{ $bitacoraAccidente->descripcion }}</dd>
            <dt>{{ trans('bitacora_accidentes.investigacion') }}</dt>
            <dd>{{ $bitacoraAccidente->investigacion }}</dd>
            <dt>{{ trans('bitacora_accidentes.procedimiento') }}</dt>
            <dd>{{ $bitacoraAccidente->procedimiento }}</dd>
            <dt>{{ trans('bitacora_accidentes.accion_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->csAccione)->accion }}</dd>
            <dt>{{ trans('bitacora_accidentes.costo_directo') }}</dt>
            <dd>{{ $bitacoraAccidente->costo_directo }}</dd>
            <dt>{{ trans('bitacora_accidentes.costo_indirecto') }}</dt>
            <dd>{{ $bitacoraAccidente->costo_indirecto }}</dd>
            <dt>{{ trans('bitacora_accidentes.fecha') }}</dt>
            <dd>{{ $bitacoraAccidente->fecha }}</dd>
            <dt>{{ trans('bitacora_accidentes.turno_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->turno)->turno }}</dd>
            <dt>{{ trans('bitacora_accidentes.entity_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->entity)->rzon_social }}</dd>
            <dt>{{ trans('bitacora_accidentes.usu_alta_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->user)->name }}</dd>
            <dt>{{ trans('bitacora_accidentes.usu_mod_id') }}</dt>
            <dd>{{ optional($bitacoraAccidente->user)->name }}</dd>
            <dt>{{ trans('bitacora_accidentes.created_at') }}</dt>
            <dd>{{ $bitacoraAccidente->created_at }}</dd>
            <dt>{{ trans('bitacora_accidentes.updated_at') }}</dt>
            <dd>{{ $bitacoraAccidente->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection