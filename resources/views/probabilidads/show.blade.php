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
				<a href="{{ route('probabilidads.probabilidad.index') }}">{{ trans('probabilidads.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('probabilidads.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('probabilidads.probabilidad.destroy', $probabilidad->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('probabilidads.probabilidad.index')
                    <a href="{{ route('probabilidads.probabilidad.index') }}" class="btn btn-primary" title="{{ trans('probabilidads.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('probabilidads.probabilidad.create')
                    <a href="{{ route('probabilidads.probabilidad.create') }}" class="btn btn-success" title="{{ trans('probabilidads.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('probabilidads.probabilidad.edit')
                    <a href="{{ route('probabilidads.probabilidad.edit', $probabilidad->id ) }}" class="btn btn-primary" title="{{ trans('probabilidads.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('probabilidads.probabilidad.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('probabilidads.delete') }}" onclick="return confirm(&quot;{{ trans('probabilidads.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('probabilidads.probabilidad') }}</dt>
            <dd>{{ $probabilidad->probabilidad }}</dd>
            <dt>{{ trans('probabilidads.usu_alta_id') }}</dt>
            <dd>{{ optional($probabilidad->user)->name }}</dd>
            <dt>{{ trans('probabilidads.usu_mod_id') }}</dt>
            <dd>{{ optional($probabilidad->user)->name }}</dd>
            <dt>{{ trans('probabilidads.created_at') }}</dt>
            <dd>{{ $probabilidad->created_at }}</dd>
            <dt>{{ trans('probabilidads.updated_at') }}</dt>
            <dd>{{ $probabilidad->updated_at }}</dd>
            <dt>{{ trans('probabilidads.deleted_at') }}</dt>
            <dd>{{ $probabilidad->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection