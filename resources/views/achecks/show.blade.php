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
				<a href="{{ route('achecks.acheck.index') }}">{{ trans('achecks.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Acheck' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('achecks.acheck.destroy', $acheck->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('achecks.acheck.index')
                    <a href="{{ route('achecks.acheck.index') }}" class="btn btn-primary" title="{{ trans('achecks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('achecks.acheck.create')
                    <a href="{{ route('achecks.acheck.create') }}" class="btn btn-success" title="{{ trans('achecks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('achecks.acheck.edit')
                    <a href="{{ route('achecks.acheck.edit', $acheck->id ) }}" class="btn btn-primary" title="{{ trans('achecks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('achecks.acheck.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('achecks.delete') }}" onclick="return confirm(&quot;{{ trans('achecks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('achecks.area') }}</dt>
            <dd>{{ $acheck->area }}</dd>
            <dt>{{ trans('achecks.usu_alta_id') }}</dt>
            <dd>{{ optional($acheck->user)->name }}</dd>
            <dt>{{ trans('achecks.usu_mod_id') }}</dt>
            <dd>{{ optional($acheck->user)->name }}</dd>
            <dt>{{ trans('achecks.created_at') }}</dt>
            <dd>{{ $acheck->created_at }}</dd>
            <dt>{{ trans('achecks.updated_at') }}</dt>
            <dd>{{ $acheck->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection