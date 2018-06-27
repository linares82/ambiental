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
				<a href="{{ route('reversibilidads.reversibilidad.index') }}">{{ trans('reversibilidads.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('reversibilidads.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('reversibilidads.reversibilidad.destroy', $reversibilidad->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('reversibilidads.reversibilidad.index')
                    <a href="{{ route('reversibilidads.reversibilidad.index') }}" class="btn btn-primary" title="{{ trans('reversibilidads.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('reversibilidads.reversibilidad.create')
                    <a href="{{ route('reversibilidads.reversibilidad.create') }}" class="btn btn-success" title="{{ trans('reversibilidads.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('reversibilidads.reversibilidad.edit')
                    <a href="{{ route('reversibilidads.reversibilidad.edit', $reversibilidad->id ) }}" class="btn btn-primary" title="{{ trans('reversibilidads.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('reversibilidads.reversibilidad.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('reversibilidads.delete') }}" onclick="return confirm(&quot;{{ trans('reversibilidads.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('reversibilidads.reversibilidad') }}</dt>
            <dd>{{ $reversibilidad->reversibilidad }}</dd>
            <dt>{{ trans('reversibilidads.usu_alta_id') }}</dt>
            <dd>{{ optional($reversibilidad->user)->name }}</dd>
            <dt>{{ trans('reversibilidads.usu_mod_id') }}</dt>
            <dd>{{ optional($reversibilidad->user)->name }}</dd>
            <dt>{{ trans('reversibilidads.created_at') }}</dt>
            <dd>{{ $reversibilidad->created_at }}</dd>
            <dt>{{ trans('reversibilidads.updated_at') }}</dt>
            <dd>{{ $reversibilidad->updated_at }}</dd>
            <dt>{{ trans('reversibilidads.deleted_at') }}</dt>
            <dd>{{ $reversibilidad->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection