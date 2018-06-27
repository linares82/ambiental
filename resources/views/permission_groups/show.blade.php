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
				<a href="{{ route('permission_groups.permission_group.index') }}">{{ trans('permission_groups.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($permissionGroup->name) ? $permissionGroup->name : 'Permission Group' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('permission_groups.permission_group.destroy', $permissionGroup->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('permission_groups.permission_group.index') }}" class="btn btn-primary" title="{{ trans('permission_groups.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('permission_groups.permission_group.create') }}" class="btn btn-success" title="{{ trans('permission_groups.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('permission_groups.permission_group.edit', $permissionGroup->id ) }}" class="btn btn-primary" title="{{ trans('permission_groups.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('permission_groups.delete') }}" onclick="return confirm(&quot;{{ trans('permission_groups.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('permission_groups.name') }}</dt>
            <dd>{{ $permissionGroup->name }}</dd>
            <dt>{{ trans('permission_groups.module') }}</dt>
            <dd>{{ $permissionGroup->module }}</dd>
            <dt>{{ trans('permission_groups.created_at') }}</dt>
            <dd>{{ $permissionGroup->created_at }}</dd>
            <dt>{{ trans('permission_groups.updated_at') }}</dt>
            <dd>{{ $permissionGroup->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection