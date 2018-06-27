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
				<a href="{{ route('cs_elementos_inspeccions.cs_elementos_inspeccion.index') }}">{{ trans('cs_elementos_inspeccions.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_elementos_inspeccions.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_elementos_inspeccions.cs_elementos_inspeccion.destroy', $csElementosInspeccion->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_elementos_inspeccions.cs_elementos_inspeccion.index')
                    <a href="{{ route('cs_elementos_inspeccions.cs_elementos_inspeccion.index') }}" class="btn btn-primary" title="{{ trans('cs_elementos_inspeccions.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_elementos_inspeccions.cs_elementos_inspeccion.create')
                    <a href="{{ route('cs_elementos_inspeccions.cs_elementos_inspeccion.create') }}" class="btn btn-success" title="{{ trans('cs_elementos_inspeccions.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_elementos_inspeccions.cs_elementos_inspeccion.edit')
                    <a href="{{ route('cs_elementos_inspeccions.cs_elementos_inspeccion.edit', $csElementosInspeccion->id ) }}" class="btn btn-primary" title="{{ trans('cs_elementos_inspeccions.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_elementos_inspeccions.cs_elementos_inspeccion.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_elementos_inspeccions.delete') }}" onclick="return confirm(&quot;{{ trans('cs_elementos_inspeccions.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_elementos_inspeccions.grupo_norma_id') }}</dt>
            <dd>{{ optional($csElementosInspeccion->csGrupoNorma)->grupo_norma }}</dd>
            <dt>{{ trans('cs_elementos_inspeccions.norma_id') }}</dt>
            <dd>{{ optional($csElementosInspeccion->csNorma)->norma }}</dd>
            <dt>{{ trans('cs_elementos_inspeccions.elemento') }}</dt>
            <dd>{{ $csElementosInspeccion->elemento }}</dd>
            <dt>{{ trans('cs_elementos_inspeccions.usu_alta_id') }}</dt>
            <dd>{{ optional($csElementosInspeccion->user)->name }}</dd>
            <dt>{{ trans('cs_elementos_inspeccions.usu_mod_id') }}</dt>
            <dd>{{ optional($csElementosInspeccion->user)->name }}</dd>
            <dt>{{ trans('cs_elementos_inspeccions.created_at') }}</dt>
            <dd>{{ $csElementosInspeccion->created_at }}</dd>
            <dt>{{ trans('cs_elementos_inspeccions.updated_at') }}</dt>
            <dd>{{ $csElementosInspeccion->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection