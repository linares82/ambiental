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
				<a href="{{ route('aa_impactos.aa_impacto.index') }}">{{ trans('aa_impactos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('aa_impactos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('aa_impactos.aa_impacto.destroy', $aaImpacto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('aa_impactos.aa_impacto.index')
                    <a href="{{ route('aa_impactos.aa_impacto.index') }}" class="btn btn-primary" title="{{ trans('aa_impactos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_impactos.aa_impacto.create')
                    <a href="{{ route('aa_impactos.aa_impacto.create') }}" class="btn btn-success" title="{{ trans('aa_impactos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_impactos.aa_impacto.edit')
                    <a href="{{ route('aa_impactos.aa_impacto.edit', $aaImpacto->id ) }}" class="btn btn-primary" title="{{ trans('aa_impactos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_impactos.aa_impacto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('aa_impactos.delete') }}" onclick="return confirm(&quot;{{ trans('aa_impactos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('aa_impactos.impacto') }}</dt>
            <dd>{{ $aaImpacto->impacto }}</dd>
            <dt>{{ trans('aa_impactos.detalle') }}</dt>
            <dd>{{ $aaImpacto->detalle }}</dd>
            <dt>{{ trans('aa_impactos.usu_alta_id') }}</dt>
            <dd>{{ optional($aaImpacto->user)->name }}</dd>
            <dt>{{ trans('aa_impactos.usu_mod_id') }}</dt>
            <dd>{{ optional($aaImpacto->user)->name }}</dd>
            <dt>{{ trans('aa_impactos.created_at') }}</dt>
            <dd>{{ $aaImpacto->created_at }}</dd>
            <dt>{{ trans('aa_impactos.updated_at') }}</dt>
            <dd>{{ $aaImpacto->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection