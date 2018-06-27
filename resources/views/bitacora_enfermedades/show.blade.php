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
				<a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.index') }}">{{ trans('bitacora_enfermedades.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('bitacora_enfermedades.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bitacora_enfermedades.bitacora_enfermedade.destroy', $bitacoraEnfermedade->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bitacora_enfermedades.bitacora_enfermedade.index')
                    <a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.index') }}" class="btn btn-primary" title="{{ trans('bitacora_enfermedades.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_enfermedades.bitacora_enfermedade.create')
                    <a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.create') }}" class="btn btn-success" title="{{ trans('bitacora_enfermedades.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_enfermedades.bitacora_enfermedade.edit')
                    <a href="{{ route('bitacora_enfermedades.bitacora_enfermedade.edit', $bitacoraEnfermedade->id ) }}" class="btn btn-primary" title="{{ trans('bitacora_enfermedades.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_enfermedades.bitacora_enfermedade.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bitacora_enfermedades.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_enfermedades.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bitacora_enfermedades.area_id') }}</dt>
            <dd>{{ optional($bitacoraEnfermedade->area)->area }}</dd>
            <dt>{{ trans('bitacora_enfermedades.persona_id') }}</dt>
            <dd>{{ optional($bitacoraEnfermedade->empleado)->nombre }}</dd>
            <dt>{{ trans('bitacora_enfermedades.enfermedad_id') }}</dt>
            <dd>{{ optional($bitacoraEnfermedade->csEnfermedade)->enfermedad }}</dd>
            <dt>{{ trans('bitacora_enfermedades.descripcion') }}</dt>
            <dd>{{ $bitacoraEnfermedade->descripcion }}</dd>
            <dt>{{ trans('bitacora_enfermedades.accion_id') }}</dt>
            <dd>{{ optional($bitacoraEnfermedade->csAccione)->accion }}</dd>
            <dt>{{ trans('bitacora_enfermedades.costo_directo') }}</dt>
            <dd>{{ $bitacoraEnfermedade->costo_directo }}</dd>
            <dt>{{ trans('bitacora_enfermedades.costo_indirecto') }}</dt>
            <dd>{{ $bitacoraEnfermedade->costo_indirecto }}</dd>
            <dt>{{ trans('bitacora_enfermedades.fecha') }}</dt>
            <dd>{{ $bitacoraEnfermedade->fecha }}</dd>
            <dt>{{ trans('bitacora_enfermedades.turno_id') }}</dt>
            <dd>{{ optional($bitacoraEnfermedade->turno)->turno }}</dd>
            <dt>{{ trans('bitacora_enfermedades.entity_id') }}</dt>
            <dd>{{ optional($bitacoraEnfermedade->entity)->rzon_social }}</dd>
            <dt>{{ trans('bitacora_enfermedades.usu_alta_id') }}</dt>
            <dd>{{ optional($bitacoraEnfermedade->user)->name }}</dd>
            <dt>{{ trans('bitacora_enfermedades.usu_mod_id') }}</dt>
            <dd>{{ optional($bitacoraEnfermedade->user)->name }}</dd>
            <dt>{{ trans('bitacora_enfermedades.created_at') }}</dt>
            <dd>{{ $bitacoraEnfermedade->created_at }}</dd>
            <dt>{{ trans('bitacora_enfermedades.updated_at') }}</dt>
            <dd>{{ $bitacoraEnfermedade->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection