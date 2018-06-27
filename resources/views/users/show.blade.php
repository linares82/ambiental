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
				<a href="{{ route('users.user.index') }}">{{ trans('users.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($user->name) ? $user->name : 'User' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('users.user.index') }}" class="btn btn-primary" title="{{ trans('users.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('users.user.create') }}" class="btn btn-success" title="{{ trans('users.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary" title="{{ trans('users.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('users.delete') }}" onclick="return confirm(&quot;{{ trans('users.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('users.name') }}</dt>
            <dd>{{ $user->name }}</dd>
            <dt>{{ trans('users.email') }}</dt>
            <dd>{{ $user->email }}</dd>
            <dt>{{ trans('users.password') }}</dt>
            <dd>{{ $user->password }}</dd>
            <dt>{{ trans('users.remember_token') }}</dt>
            <dd>{{ $user->remember_token }}</dd>
            <dt>{{ trans('users.created_at') }}</dt>
            <dd>{{ $user->created_at }}</dd>
            <dt>{{ trans('users.updated_at') }}</dt>
            <dd>{{ $user->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection