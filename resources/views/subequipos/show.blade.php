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
				<a href="{{ route('subequipos.subequipo.index') }}">{{ trans('subequipos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('subequipos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('subequipos.subequipo.destroy', $subequipo->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('subequipos.subequipo.index')
                    <a href="{{ route('subequipos.subequipo.index') }}" class="btn btn-primary" title="{{ trans('subequipos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('subequipos.subequipo.create')
                    <a href="{{ route('subequipos.subequipo.create') }}" class="btn btn-success" title="{{ trans('subequipos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('subequipos.subequipo.edit')
                    <a href="{{ route('subequipos.subequipo.edit', $subequipo->id ) }}" class="btn btn-primary" title="{{ trans('subequipos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('subequipos.subequipo.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('subequipos.delete') }}" onclick="return confirm(&quot;{{ trans('subequipos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('subequipos.equipo_id') }}</dt>
            <dd>{{ optional($subequipo->mObjetivo)->objetivo }}</dd>
            <dt>{{ trans('subequipos.subequipo') }}</dt>
            <dd>{{ $subequipo->subequipo }}</dd>
            <dt>{{ trans('subequipos.clase') }}</dt>
            <dd>{{ $subequipo->clase }}</dd>
            <dt>{{ trans('subequipos.marca') }}</dt>
            <dd>{{ $subequipo->marca }}</dd>
            <dt>{{ trans('subequipos.modelo') }}</dt>
            <dd>{{ $subequipo->modelo }}</dd>
            <dt>{{ trans('subequipos.no_serie') }}</dt>
            <dd>{{ $subequipo->no_serie }}</dd>
            <dt>{{ trans('subequipos.fecha_carga') }}</dt>
            <dd>{{ $subequipo->fecha_carga }}</dd>
            <dt>{{ trans('subequipos.area_id') }}</dt>
            <dd>{{ optional($subequipo->area)->area }}</dd>
            <dt>{{ trans('subequipos.ubicacion') }}</dt>
            <dd>{{ $subequipo->ubicacion }}</dd>
            <dt>{{ trans('subequipos.usu_alta_id') }}</dt>
            <dd>{{ optional($subequipo->user)->name }}</dd>
            <dt>{{ trans('subequipos.usu_mod_id') }}</dt>
            <dd>{{ optional($subequipo->user)->name }}</dd>
            <dt>{{ trans('subequipos.created_at') }}</dt>
            <dd>{{ $subequipo->created_at }}</dd>
            <dt>{{ trans('subequipos.updated_at') }}</dt>
            <dd>{{ $subequipo->updated_at }}</dd>
            <dt>{{ trans('subequipos.entity_id') }}</dt>
            <dd>{{ optional($subequipo->entity)->rzon_social }}</dd>

        </dl>

    </div>
</div>

@endsection