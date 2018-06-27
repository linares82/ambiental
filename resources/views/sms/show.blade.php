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
				<a href="{{ route('sms.sm.index') }}">{{ trans('sms.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Sm' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('sms.sm.destroy', $sm->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('sms.sm.index')
                    <a href="{{ route('sms.sm.index') }}" class="btn btn-primary" title="{{ trans('sms.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('sms.sm.create')
                    <a href="{{ route('sms.sm.create') }}" class="btn btn-success" title="{{ trans('sms.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('sms.sm.edit')
                    <a href="{{ route('sms.sm.edit', $sm->id ) }}" class="btn btn-primary" title="{{ trans('sms.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('sms.sm.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('sms.delete') }}" onclick="return confirm(&quot;{{ trans('sms.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('sms.monto') }}</dt>
            <dd>{{ $sm->monto }}</dd>
            <dt>{{ trans('sms.usu_mod_id') }}</dt>
            <dd>{{ optional($sm->user)->name }}</dd>
            <dt>{{ trans('sms.created_at') }}</dt>
            <dd>{{ $sm->created_at }}</dd>
            <dt>{{ trans('sms.updated_at') }}</dt>
            <dd>{{ $sm->updated_at }}</dd>
          
        </dl>

    </div>
</div>

@endsection