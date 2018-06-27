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
				<a href="{{ route('caracteristicas.caracteristica.index') }}">{{ trans('caracteristicas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Caracteristica' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('caracteristicas.caracteristica.destroy', $caracteristica->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('caracteristicas.caracteristica.index')
                    <a href="{{ route('caracteristicas.caracteristica.index') }}" class="btn btn-primary" title="{{ trans('caracteristicas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('caracteristicas.caracteristica.create')
                    <a href="{{ route('caracteristicas.caracteristica.create') }}" class="btn btn-success" title="{{ trans('caracteristicas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('caracteristicas.caracteristica.edit')
                    <a href="{{ route('caracteristicas.caracteristica.edit', $caracteristica->id ) }}" class="btn btn-primary" title="{{ trans('caracteristicas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('caracteristicas.caracteristica.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('caracteristicas.delete') }}" onclick="return confirm(&quot;{{ trans('caracteristicas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('caracteristicas.caracteristica') }}</dt>
            <dd>{{ $caracteristica->caracteristica }}</dd>
            <dt>{{ trans('caracteristicas.usu_alta_id') }}</dt>
            <dd>{{ optional($caracteristica->user)->name }}</dd>
            <dt>{{ trans('caracteristicas.usu_mod_id') }}</dt>
            <dd>{{ optional($caracteristica->user)->name }}</dd>
            <dt>{{ trans('caracteristicas.created_at') }}</dt>
            <dd>{{ $caracteristica->created_at }}</dd>
            <dt>{{ trans('caracteristicas.updated_at') }}</dt>
            <dd>{{ $caracteristica->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection