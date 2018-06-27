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
				<a href="{{ route('ln_impactos.ln_impacto.index') }}">{{ trans('ln_impactos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ln_impactos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ln_impactos.ln_impacto.destroy', $lnImpacto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ln_impactos.ln_impacto.index')
                    <a href="{{ route('ln_impactos.ln_impacto.index') }}" class="btn btn-primary" title="{{ trans('ln_impactos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ln_impactos.ln_impacto.create')
                    <a href="{{ route('ln_impactos.ln_impacto.create') }}" class="btn btn-success" title="{{ trans('ln_impactos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ln_impactos.ln_impacto.edit')
                    <a href="{{ route('ln_impactos.ln_impacto.edit', $lnImpacto->id ) }}" class="btn btn-primary" title="{{ trans('ln_impactos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ln_impactos.ln_impacto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ln_impactos.delete') }}" onclick="return confirm(&quot;{{ trans('ln_impactos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ln_impactos.enc_impacto_id') }}</dt>
            <dd>{{ optional($lnImpacto->encImpacto)->fecha_inicio }}</dd>
            <dt>{{ trans('ln_impactos.factor_id') }}</dt>
            <dd>{{ optional($lnImpacto->factor)->factor }}</dd>
            <dt>{{ trans('ln_impactos.rubro_id') }}</dt>
            <dd>{{ optional($lnImpacto->rubro)->rubro }}</dd>
            <dt>{{ trans('ln_impactos.especifico_id') }}</dt>
            <dd>{{ optional($lnImpacto->especifico)->especifico }}</dd>
            <dt>{{ trans('ln_impactos.estatus_id') }}</dt>
            <dd>{{ optional($lnImpacto->stRegImpacto)->id }}</dd>
            <dt>{{ trans('ln_impactos.usu_alta_id') }}</dt>
            <dd>{{ optional($lnImpacto->user)->name }}</dd>
            <dt>{{ trans('ln_impactos.usu_mod_id') }}</dt>
            <dd>{{ optional($lnImpacto->user)->name }}</dd>
            <dt>{{ trans('ln_impactos.created_at') }}</dt>
            <dd>{{ $lnImpacto->created_at }}</dd>
            <dt>{{ trans('ln_impactos.updated_at') }}</dt>
            <dd>{{ $lnImpacto->updated_at }}</dd>
            <dt>{{ trans('ln_impactos.deleted_at') }}</dt>
            <dd>{{ $lnImpacto->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection