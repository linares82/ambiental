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
				<a href="{{ route('checks.check.index') }}">{{ trans('checks.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('checks.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('checks.check.destroy', $check->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('checks.check.index')
                    <a href="{{ route('checks.check.index') }}" class="btn btn-primary" title="{{ trans('checks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('checks.check.create')
                    <a href="{{ route('checks.check.create') }}" class="btn btn-success" title="{{ trans('checks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('checks.check.edit')
                    <a href="{{ route('checks.check.edit', $check->id ) }}" class="btn btn-primary" title="{{ trans('checks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('checks.check.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('checks.delete') }}" onclick="return confirm(&quot;{{ trans('checks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('checks.cliente') }}</dt>
            <dd>{{ optional($check->cliente)->cliente }}</dd>
            <dt>{{ trans('checks.a_check_id') }}</dt>
            <dd>{{ optional($check->aCheck)->area }}</dd>
            <dt>{{ trans('checks.solicitud') }}</dt>
            <dd>{{ $check->solicitud }}</dd>
            <dt>{{ trans('checks.detalle') }}</dt>
            <dd>{{ $check->detalle }}</dd>
            <dt>{{ trans('checks.fec_apertura') }}</dt>
            <dd>{{ $check->fec_apertura }}</dd>
            <dt>{{ trans('checks.fec_cierre') }}</dt>
            <dd>{{ $check->fec_cierre }}</dd>
            <dt>{{ trans('checks.usu_alta_id') }}</dt>
            <dd>{{ optional($check->user)->name }}</dd>
            <dt>{{ trans('checks.usu_mod_id') }}</dt>
            <dd>{{ optional($check->user)->name }}</dd>
            <dt>{{ trans('checks.created_at') }}</dt>
            <dd>{{ $check->created_at }}</dd>
            <dt>{{ trans('checks.updated_at') }}</dt>
            <dd>{{ $check->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection