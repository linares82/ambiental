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
				<a href="{{ route('turnos.turno.index') }}">{{ trans('turnos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('turnos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('turnos.turno.destroy', $turno->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('turnos.turno.index')
                    <a href="{{ route('turnos.turno.index') }}" class="btn btn-primary" title="{{ trans('turnos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('turnos.turno.create')
                    <a href="{{ route('turnos.turno.create') }}" class="btn btn-success" title="{{ trans('turnos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('turnos.turno.edit')
                    <a href="{{ route('turnos.turno.edit', $turno->id ) }}" class="btn btn-primary" title="{{ trans('turnos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('turnos.turno.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('turnos.delete') }}" onclick="return confirm(&quot;{{ trans('turnos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('turnos.turno') }}</dt>
            <dd>{{ $turno->turno }}</dd>
            <dt>{{ trans('turnos.usu_alta_id') }}</dt>
            <dd>{{ optional($turno->user)->name }}</dd>
            <dt>{{ trans('turnos.usu_mod_id') }}</dt>
            <dd>{{ optional($turno->user)->name }}</dd>
            <dt>{{ trans('turnos.created_at') }}</dt>
            <dd>{{ $turno->created_at }}</dd>
            <dt>{{ trans('turnos.updated_at') }}</dt>
            <dd>{{ $turno->updated_at }}</dd>
            <dt>{{ trans('turnos.deleted_at') }}</dt>
            <dd>{{ $turno->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection