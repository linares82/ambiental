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
				<a href="{{ route('mitigacions.mitigacion.index') }}">{{ trans('mitigacions.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('mitigacions.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('mitigacions.mitigacion.destroy', $mitigacion->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('mitigacions.mitigacion.index')
                    <a href="{{ route('mitigacions.mitigacion.index') }}" class="btn btn-primary" title="{{ trans('mitigacions.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('mitigacions.mitigacion.create')
                    <a href="{{ route('mitigacions.mitigacion.create') }}" class="btn btn-success" title="{{ trans('mitigacions.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('mitigacions.mitigacion.edit')
                    <a href="{{ route('mitigacions.mitigacion.edit', $mitigacion->id ) }}" class="btn btn-primary" title="{{ trans('mitigacions.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('mitigacions.mitigacion.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('mitigacions.delete') }}" onclick="return confirm(&quot;{{ trans('mitigacions.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('mitigacions.mitigacion') }}</dt>
            <dd>{{ $mitigacion->mitigacion }}</dd>
            <dt>{{ trans('mitigacions.usu_alta_id') }}</dt>
            <dd>{{ optional($mitigacion->user)->name }}</dd>
            <dt>{{ trans('mitigacions.usu_mod_id') }}</dt>
            <dd>{{ optional($mitigacion->user)->name }}</dd>
            <dt>{{ trans('mitigacions.created_at') }}</dt>
            <dd>{{ $mitigacion->created_at }}</dd>
            <dt>{{ trans('mitigacions.updated_at') }}</dt>
            <dd>{{ $mitigacion->updated_at }}</dd>
            <dt>{{ trans('mitigacions.deleted_at') }}</dt>
            <dd>{{ $mitigacion->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection