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
				<a href="{{ route('permissions.permission.index') }}">{{ trans('permissions.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($permission->name) ? $permission->name : 'Permission' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('permissions.permission.destroy', $permission->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('permissions.permission.index') }}" class="btn btn-primary" title="{{ trans('permissions.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('permissions.permission.create') }}" class="btn btn-success" title="{{ trans('permissions.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('permissions.permission.edit', $permission->id ) }}" class="btn btn-primary" title="{{ trans('permissions.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('permissions.delete') }}" onclick="return confirm(&quot;{{ trans('permissions.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('permissions.slug') }}</dt>
            <dd>{{ $permission->slug }}</dd>
            <dt>{{ trans('permissions.name') }}</dt>
            <dd>{{ $permission->name }}</dd>
            <dt>{{ trans('permissions.created_at') }}</dt>
            <dd>{{ $permission->created_at }}</dd>
            <dt>{{ trans('permissions.updated_at') }}</dt>
            <dd>{{ $permission->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection