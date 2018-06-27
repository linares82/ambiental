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
				<a href="{{ route('st_reg_impactos.st_reg_impacto.index') }}">{{ trans('st_reg_impactos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('st_reg_impactos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('st_reg_impactos.st_reg_impacto.destroy', $stRegImpacto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('st_reg_impactos.st_reg_impacto.index')
                    <a href="{{ route('st_reg_impactos.st_reg_impacto.index') }}" class="btn btn-primary" title="{{ trans('st_reg_impactos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('st_reg_impactos.st_reg_impacto.create')
                    <a href="{{ route('st_reg_impactos.st_reg_impacto.create') }}" class="btn btn-success" title="{{ trans('st_reg_impactos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('st_reg_impactos.st_reg_impacto.edit')
                    <a href="{{ route('st_reg_impactos.st_reg_impacto.edit', $stRegImpacto->id ) }}" class="btn btn-primary" title="{{ trans('st_reg_impactos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('st_reg_impactos.st_reg_impacto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('st_reg_impactos.delete') }}" onclick="return confirm(&quot;{{ trans('st_reg_impactos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('st_reg_impactos.st_reg_impacto') }}</dt>
            <dd>{{ $stRegImpacto->st_reg_impacto }}</dd>
            <dt>{{ trans('st_reg_impactos.usu_alta_id') }}</dt>
            <dd>{{ optional($stRegImpacto->user)->name }}</dd>
            <dt>{{ trans('st_reg_impactos.usu_mod_id') }}</dt>
            <dd>{{ optional($stRegImpacto->user)->name }}</dd>
            <dt>{{ trans('st_reg_impactos.created_at') }}</dt>
            <dd>{{ $stRegImpacto->created_at }}</dd>
            <dt>{{ trans('st_reg_impactos.updated_at') }}</dt>
            <dd>{{ $stRegImpacto->updated_at }}</dd>
            <dt>{{ trans('st_reg_impactos.deleted_at') }}</dt>
            <dd>{{ $stRegImpacto->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection