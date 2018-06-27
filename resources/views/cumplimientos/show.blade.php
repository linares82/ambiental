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
				<a href="{{ route('cumplimientos.cumplimiento.index') }}">{{ trans('cumplimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('cumplimientos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cumplimientos.cumplimiento.destroy', $cumplimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cumplimientos.cumplimiento.index')
                    <a href="{{ route('cumplimientos.cumplimiento.index') }}" class="btn btn-primary" title="{{ trans('cumplimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cumplimientos.cumplimiento.create')
                    <a href="{{ route('cumplimientos.cumplimiento.create') }}" class="btn btn-success" title="{{ trans('cumplimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cumplimientos.cumplimiento.edit')
                    <a href="{{ route('cumplimientos.cumplimiento.edit', $cumplimiento->id ) }}" class="btn btn-primary" title="{{ trans('cumplimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cumplimientos.cumplimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cumplimientos.delete') }}" onclick="return confirm(&quot;{{ trans('cumplimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cumplimientos.cumplimiento') }}</dt>
            <dd>{{ $cumplimiento->cumplimiento }}</dd>
            <dt>{{ trans('cumplimientos.usu_alta_id') }}</dt>
            <dd>{{ optional($cumplimiento->user)->name }}</dd>
            <dt>{{ trans('cumplimientos.usu_mod_id') }}</dt>
            <dd>{{ optional($cumplimiento->user)->name }}</dd>
            <dt>{{ trans('cumplimientos.created_at') }}</dt>
            <dd>{{ $cumplimiento->created_at }}</dd>
            <dt>{{ trans('cumplimientos.updated_at') }}</dt>
            <dd>{{ $cumplimiento->updated_at }}</dd>
            <dt>{{ trans('cumplimientos.deleted_at') }}</dt>
            <dd>{{ $cumplimiento->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection