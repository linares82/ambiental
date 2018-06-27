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
				<a href="{{ route('matrizs.matriz.index') }}">{{ trans('matrizs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Matriz' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('matrizs.matriz.destroy', $matriz->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('matrizs.matriz.index')
                    <a href="{{ route('matrizs.matriz.index') }}" class="btn btn-primary" title="{{ trans('matrizs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('matrizs.matriz.create')
                    <a href="{{ route('matrizs.matriz.create') }}" class="btn btn-success" title="{{ trans('matrizs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('matrizs.matriz.edit')
                    <a href="{{ route('matrizs.matriz.edit', $matriz->id ) }}" class="btn btn-primary" title="{{ trans('matrizs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('matrizs.matriz.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('matrizs.delete') }}" onclick="return confirm(&quot;{{ trans('matrizs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('matrizs.tipo_impacto_id') }}</dt>
            <dd>{{ optional($matriz->tipoImpacto)->tipo_impacto }}</dd>
            <dt>{{ trans('matrizs.factor_id') }}</dt>
            <dd>{{ optional($matriz->factor)->factor }}</dd>
            <dt>{{ trans('matrizs.rubro_id') }}</dt>
            <dd>{{ optional($matriz->rubro)->rubro }}</dd>
            <dt>{{ trans('matrizs.especifico_id') }}</dt>
            <dd>{{ optional($matriz->especifico)->especifico }}</dd>
            <dt>{{ trans('matrizs.usu_alta_id') }}</dt>
            <dd>{{ optional($matriz->user)->name }}</dd>
            <dt>{{ trans('matrizs.usu_mod_id') }}</dt>
            <dd>{{ optional($matriz->user)->name }}</dd>
            <dt>{{ trans('matrizs.created_at') }}</dt>
            <dd>{{ $matriz->created_at }}</dd>
            <dt>{{ trans('matrizs.updated_at') }}</dt>
            <dd>{{ $matriz->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection