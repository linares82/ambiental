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
				<a href="{{ route('estatus_requisitos.estatus_requisito.index') }}">{{ trans('estatus_requisitos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('estatus_requisitos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('estatus_requisitos.estatus_requisito.destroy', $estatusRequisito->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('estatus_requisitos.estatus_requisito.index')
                    <a href="{{ route('estatus_requisitos.estatus_requisito.index') }}" class="btn btn-primary" title="{{ trans('estatus_requisitos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estatus_requisitos.estatus_requisito.create')
                    <a href="{{ route('estatus_requisitos.estatus_requisito.create') }}" class="btn btn-success" title="{{ trans('estatus_requisitos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estatus_requisitos.estatus_requisito.edit')
                    <a href="{{ route('estatus_requisitos.estatus_requisito.edit', $estatusRequisito->id ) }}" class="btn btn-primary" title="{{ trans('estatus_requisitos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estatus_requisitos.estatus_requisito.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('estatus_requisitos.delete') }}" onclick="return confirm(&quot;{{ trans('estatus_requisitos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('estatus_requisitos.estatus') }}</dt>
            <dd>{{ $estatusRequisito->estatus }}</dd>
            <dt>{{ trans('estatus_requisitos.usu_alta_id') }}</dt>
            <dd>{{ optional($estatusRequisito->user)->name }}</dd>
            <dt>{{ trans('estatus_requisitos.usu_mod_id') }}</dt>
            <dd>{{ optional($estatusRequisito->user)->name }}</dd>
            <dt>{{ trans('estatus_requisitos.created_at') }}</dt>
            <dd>{{ $estatusRequisito->created_at }}</dd>
            <dt>{{ trans('estatus_requisitos.updated_at') }}</dt>
            <dd>{{ $estatusRequisito->updated_at }}</dd>
            <dt>{{ trans('estatus_requisitos.deleted_at') }}</dt>
            <dd>{{ $estatusRequisito->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection