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
				<a href="{{ route('roles.role.index') }}">{{ trans('roles.model_plural') }}</a>
			</li>
			<li class="active">mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($role->name) ? $role->name : 'Role' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('roles.role.destroy', $role->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('roles.role.index') }}" class="btn btn-primary" title="{{ trans('roles.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('roles.role.create') }}" class="btn btn-success" title="{{ trans('roles.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('roles.role.edit', $role->id ) }}" class="btn btn-primary" title="{{ trans('roles.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('roles.delete') }}" onclick="return confirm(&quot;{{ trans('roles.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('roles.slug') }}</dt>
            <dd>{{ $role->slug }}</dd>
            <dt>{{ trans('roles.name') }}</dt>
            <dd>{{ $role->name }}</dd>
            <dt>{{ trans('roles.created_at') }}</dt>
            <dd>{{ $role->created_at }}</dd>
            <dt>{{ trans('roles.updated_at') }}</dt>
            <dd>{{ $role->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection