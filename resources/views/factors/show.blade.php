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
				<a href="{{ route('factors.factor.index') }}">{{ trans('factors.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Factor' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('factors.factor.destroy', $factor->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('factors.factor.index')
                    <a href="{{ route('factors.factor.index') }}" class="btn btn-primary" title="{{ trans('factors.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('factors.factor.create')
                    <a href="{{ route('factors.factor.create') }}" class="btn btn-success" title="{{ trans('factors.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('factors.factor.edit')
                    <a href="{{ route('factors.factor.edit', $factor->id ) }}" class="btn btn-primary" title="{{ trans('factors.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('factors.factor.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('factors.delete') }}" onclick="return confirm(&quot;{{ trans('factors.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('factors.factor') }}</dt>
            <dd>{{ $factor->factor }}</dd>
            <dt>{{ trans('factors.usu_alta_id') }}</dt>
            <dd>{{ optional($factor->user)->name }}</dd>
            <dt>{{ trans('factors.usu_mod_id') }}</dt>
            <dd>{{ optional($factor->user)->name }}</dd>
            <dt>{{ trans('factors.created_at') }}</dt>
            <dd>{{ $factor->created_at }}</dd>
            <dt>{{ trans('factors.updated_at') }}</dt>
            <dd>{{ $factor->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection