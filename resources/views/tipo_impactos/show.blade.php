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
				<a href="{{ route('tipo_impactos.tipo_impacto.index') }}">{{ trans('tipo_impactos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('tipo_impactos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('tipo_impactos.tipo_impacto.destroy', $tipoImpacto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('tipo_impactos.tipo_impacto.index')
                    <a href="{{ route('tipo_impactos.tipo_impacto.index') }}" class="btn btn-primary" title="{{ trans('tipo_impactos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tipo_impactos.tipo_impacto.create')
                    <a href="{{ route('tipo_impactos.tipo_impacto.create') }}" class="btn btn-success" title="{{ trans('tipo_impactos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tipo_impactos.tipo_impacto.edit')
                    <a href="{{ route('tipo_impactos.tipo_impacto.edit', $tipoImpacto->id ) }}" class="btn btn-primary" title="{{ trans('tipo_impactos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tipo_impactos.tipo_impacto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('tipo_impactos.delete') }}" onclick="return confirm(&quot;{{ trans('tipo_impactos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('tipo_impactos.tipo_impacto') }}</dt>
            <dd>{{ $tipoImpacto->tipo_impacto }}</dd>
            <dt>{{ trans('tipo_impactos.usu_alta_id') }}</dt>
            <dd>{{ optional($tipoImpacto->user)->name }}</dd>
            <dt>{{ trans('tipo_impactos.usu_mod_id') }}</dt>
            <dd>{{ optional($tipoImpacto->user)->name }}</dd>
            <dt>{{ trans('tipo_impactos.created_at') }}</dt>
            <dd>{{ $tipoImpacto->created_at }}</dd>
            <dt>{{ trans('tipo_impactos.updated_at') }}</dt>
            <dd>{{ $tipoImpacto->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection