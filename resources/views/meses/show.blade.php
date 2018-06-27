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
				<a href="{{ route('meses.meses.index') }}">{{ trans('meses.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('meses.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('meses.meses.destroy', $meses->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('meses.meses.index')
                    <a href="{{ route('meses.meses.index') }}" class="btn btn-primary" title="{{ trans('meses.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('meses.meses.create')
                    <a href="{{ route('meses.meses.create') }}" class="btn btn-success" title="{{ trans('meses.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('meses.meses.edit')
                    <a href="{{ route('meses.meses.edit', $meses->id ) }}" class="btn btn-primary" title="{{ trans('meses.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('meses.meses.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('meses.delete') }}" onclick="return confirm(&quot;{{ trans('meses.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('meses.mes') }}</dt>
            <dd>{{ $meses->mes }}</dd>
            <dt>{{ trans('meses.usu_alta_id') }}</dt>
            <dd>{{ optional($meses->user)->name }}</dd>
            <dt>{{ trans('meses.usu_mod_id') }}</dt>
            <dd>{{ optional($meses->user)->name }}</dd>
            <dt>{{ trans('meses.created_at') }}</dt>
            <dd>{{ $meses->created_at }}</dd>
            <dt>{{ trans('meses.updated_at') }}</dt>
            <dd>{{ $meses->updated_at }}</dd>
            <dt>{{ trans('meses.deleted_at') }}</dt>
            <dd>{{ $meses->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection