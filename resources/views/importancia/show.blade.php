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
				<a href="{{ route('importancia.importancium.index') }}">{{ trans('importancia.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('importancia.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('importancia.importancium.destroy', $importancium->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('importancia.importancium.index')
                    <a href="{{ route('importancia.importancium.index') }}" class="btn btn-primary" title="{{ trans('importancia.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('importancia.importancium.create')
                    <a href="{{ route('importancia.importancium.create') }}" class="btn btn-success" title="{{ trans('importancia.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('importancia.importancium.edit')
                    <a href="{{ route('importancia.importancium.edit', $importancium->id ) }}" class="btn btn-primary" title="{{ trans('importancia.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('importancia.importancium.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('importancia.delete') }}" onclick="return confirm(&quot;{{ trans('importancia.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('importancia.importancia') }}</dt>
            <dd>{{ $importancium->importancia }}</dd>
            <dt>{{ trans('importancia.usu_alta_id') }}</dt>
            <dd>{{ optional($importancium->user)->name }}</dd>
            <dt>{{ trans('importancia.usu_mod_id') }}</dt>
            <dd>{{ optional($importancium->user)->name }}</dd>
            <dt>{{ trans('importancia.created_at') }}</dt>
            <dd>{{ $importancium->created_at }}</dd>
            <dt>{{ trans('importancia.updated_at') }}</dt>
            <dd>{{ $importancium->updated_at }}</dd>
            <dt>{{ trans('importancia.deleted_at') }}</dt>
            <dd>{{ $importancium->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection