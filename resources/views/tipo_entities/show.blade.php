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
				<a href="{{ route('tipo_entities.tipo_entity.index') }}">{{ trans('tipo_entities.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('tipo_entities.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('tipo_entities.tipo_entity.destroy', $tipoEntity->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('tipo_entities.tipo_entity.index')
                    <a href="{{ route('tipo_entities.tipo_entity.index') }}" class="btn btn-primary" title="{{ trans('tipo_entities.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tipo_entities.tipo_entity.create')
                    <a href="{{ route('tipo_entities.tipo_entity.create') }}" class="btn btn-success" title="{{ trans('tipo_entities.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tipo_entities.tipo_entity.edit')
                    <a href="{{ route('tipo_entities.tipo_entity.edit', $tipoEntity->id ) }}" class="btn btn-primary" title="{{ trans('tipo_entities.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tipo_entities.tipo_entity.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('tipo_entities.delete') }}" onclick="return confirm(&quot;{{ trans('tipo_entities.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('tipo_entities.tipo_entity') }}</dt>
            <dd>{{ $tipoEntity->tipo_entity }}</dd>
            <dt>{{ trans('tipo_entities.usu_alta_id') }}</dt>
            <dd>{{ optional($tipoEntity->user)->name }}</dd>
            <dt>{{ trans('tipo_entities.usu_mod_id') }}</dt>
            <dd>{{ optional($tipoEntity->user)->name }}</dd>
            <dt>{{ trans('tipo_entities.created_at') }}</dt>
            <dd>{{ $tipoEntity->created_at }}</dd>
            <dt>{{ trans('tipo_entities.updated_at') }}</dt>
            <dd>{{ $tipoEntity->updated_at }}</dd>
            <dt>{{ trans('tipo_entities.deleted_at') }}</dt>
            <dd>{{ $tipoEntity->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection