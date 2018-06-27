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
				<a href="{{ route('ca_procedimientos.ca_procedimiento.index') }}">{{ trans('ca_procedimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_procedimientos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_procedimientos.ca_procedimiento.destroy', $caProcedimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_procedimientos.ca_procedimiento.index')
                    <a href="{{ route('ca_procedimientos.ca_procedimiento.index') }}" class="btn btn-primary" title="{{ trans('ca_procedimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_procedimientos.ca_procedimiento.create')
                    <a href="{{ route('ca_procedimientos.ca_procedimiento.create') }}" class="btn btn-success" title="{{ trans('ca_procedimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_procedimientos.ca_procedimiento.edit')
                    <a href="{{ route('ca_procedimientos.ca_procedimiento.edit', $caProcedimiento->id ) }}" class="btn btn-primary" title="{{ trans('ca_procedimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_procedimientos.ca_procedimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_procedimientos.delete') }}" onclick="return confirm(&quot;{{ trans('ca_procedimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_procedimientos.procedimiento') }}</dt>
            <dd>{{ $caProcedimiento->procedimiento }}</dd>
            <dt>{{ trans('ca_procedimientos.usu_alta_id') }}</dt>
            <dd>{{ optional($caProcedimiento->user)->name }}</dd>
            <dt>{{ trans('ca_procedimientos.usu_mod_id') }}</dt>
            <dd>{{ optional($caProcedimiento->user)->name }}</dd>
            <dt>{{ trans('ca_procedimientos.created_at') }}</dt>
            <dd>{{ $caProcedimiento->created_at }}</dd>
            <dt>{{ trans('ca_procedimientos.updated_at') }}</dt>
            <dd>{{ $caProcedimiento->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection