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
				<a href="{{ route('a_checks.a_check.index') }}">{{ trans('a_checks.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('a_checks.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_checks.a_check.destroy', $aCheck->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_checks.a_check.index')
                    <a href="{{ route('a_checks.a_check.index') }}" class="btn btn-primary" title="{{ trans('a_checks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_checks.a_check.create')
                    <a href="{{ route('a_checks.a_check.create') }}" class="btn btn-success" title="{{ trans('a_checks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_checks.a_check.edit')
                    <a href="{{ route('a_checks.a_check.edit', $aCheck->id ) }}" class="btn btn-primary" title="{{ trans('a_checks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_checks.a_check.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_checks.delete') }}" onclick="return confirm(&quot;{{ trans('a_checks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_checks.area') }}</dt>
            <dd>{{ $aCheck->area }}</dd>
            <dt>{{ trans('a_checks.usu_alta_id') }}</dt>
            <dd>{{ optional($aCheck->user)->name }}</dd>
            <dt>{{ trans('a_checks.usu_mod_id') }}</dt>
            <dd>{{ optional($aCheck->user)->name }}</dd>
            <dt>{{ trans('a_checks.created_at') }}</dt>
            <dd>{{ $aCheck->created_at }}</dd>
            <dt>{{ trans('a_checks.updated_at') }}</dt>
            <dd>{{ $aCheck->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection