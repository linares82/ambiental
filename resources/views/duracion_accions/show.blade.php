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
				<a href="{{ route('duracion_accions.duracion_accion.index') }}">{{ trans('duracion_accions.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('duracion_accions.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('duracion_accions.duracion_accion.destroy', $duracionAccion->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('duracion_accions.duracion_accion.index')
                    <a href="{{ route('duracion_accions.duracion_accion.index') }}" class="btn btn-primary" title="{{ trans('duracion_accions.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('duracion_accions.duracion_accion.create')
                    <a href="{{ route('duracion_accions.duracion_accion.create') }}" class="btn btn-success" title="{{ trans('duracion_accions.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('duracion_accions.duracion_accion.edit')
                    <a href="{{ route('duracion_accions.duracion_accion.edit', $duracionAccion->id ) }}" class="btn btn-primary" title="{{ trans('duracion_accions.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('duracion_accions.duracion_accion.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('duracion_accions.delete') }}" onclick="return confirm(&quot;{{ trans('duracion_accions.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('duracion_accions.duracion_accion') }}</dt>
            <dd>{{ $duracionAccion->duracion_accion }}</dd>
            <dt>{{ trans('duracion_accions.usu_alta_id') }}</dt>
            <dd>{{ optional($duracionAccion->user)->name }}</dd>
            <dt>{{ trans('duracion_accions.usu_mod_id') }}</dt>
            <dd>{{ optional($duracionAccion->user)->name }}</dd>
            <dt>{{ trans('duracion_accions.created_at') }}</dt>
            <dd>{{ $duracionAccion->created_at }}</dd>
            <dt>{{ trans('duracion_accions.updated_at') }}</dt>
            <dd>{{ $duracionAccion->updated_at }}</dd>
            <dt>{{ trans('duracion_accions.deleted_at') }}</dt>
            <dd>{{ $duracionAccion->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection