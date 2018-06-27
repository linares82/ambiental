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
				<a href="{{ route('check_ls.check_l.index') }}">{{ trans('check_ls.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('check_ls.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('check_ls.check_l.destroy', $checkL->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('check_ls.check_l.index')
                    <a href="{{ route('check_ls.check_l.index') }}" class="btn btn-primary" title="{{ trans('check_ls.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('check_ls.check_l.create')
                    <a href="{{ route('check_ls.check_l.create') }}" class="btn btn-success" title="{{ trans('check_ls.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('check_ls.check_l.edit')
                    <a href="{{ route('check_ls.check_l.edit', $checkL->id ) }}" class="btn btn-primary" title="{{ trans('check_ls.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('check_ls.check_l.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('check_ls.delete') }}" onclick="return confirm(&quot;{{ trans('check_ls.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('check_ls.check_id') }}</dt>
            <dd>{{ optional($checkL->check)->cliente }}</dd>
            <dt>{{ trans('check_ls.a_check_id') }}</dt>
            <dd>{{ optional($checkL->aCheck)->area }}</dd>
            <dt>{{ trans('check_ls.norma_id') }}</dt>
            <dd>{{ optional($checkL->norma)->norma }}</dd>
            <dt>{{ trans('check_ls.no_conformidad') }}</dt>
            <dd>{{ $checkL->no_conformidad }}</dd>
            <dt>{{ trans('check_ls.especifico') }}</dt>
            <dd>{{ $checkL->especifico }}</dd>
            <dt>{{ trans('check_ls.requisito') }}</dt>
            <dd>{{ $checkL->requisito }}</dd>
            <dt>{{ trans('check_ls.rnc') }}</dt>
            <dd>{{ $checkL->rnc }}</dd>
            <dt>{{ trans('check_ls.minimo_vsm') }}</dt>
            <dd>{{ $checkL->minimo_vsm }}</dd>
            <dt>{{ trans('check_ls.maximo_vsm') }}</dt>
            <dd>{{ $checkL->maximo_vsm }}</dd>
            <dt>{{ trans('check_ls.cumplimiento') }}</dt>
            <dd>{{ optional($checkL->cumplimiento)->id }}</dd>
            <dt>{{ trans('check_ls.monto_min') }}</dt>
            <dd>{{ $checkL->monto_min }}</dd>
            <dt>{{ trans('check_ls.monto_medio') }}</dt>
            <dd>{{ $checkL->monto_medio }}</dd>
            <dt>{{ trans('check_ls.monto_max') }}</dt>
            <dd>{{ $checkL->monto_max }}</dd>
            <dt>{{ trans('check_ls.correccion') }}</dt>
            <dd>{{ $checkL->correccion }}</dd>
            <dt>{{ trans('check_ls.correccion_detallada') }}</dt>
            <dd>{{ $checkL->correccion_detallada }}</dd>
            <dt>{{ trans('check_ls.t_semanas') }}</dt>
            <dd>{{ $checkL->t_semanas }}</dd>
            <dt>{{ trans('check_ls.responsable') }}</dt>
            <dd>{{ $checkL->responsable }}</dd>
            <dt>{{ trans('check_ls.monto_estimado') }}</dt>
            <dd>{{ $checkL->monto_estimado }}</dd>
            <dt>{{ trans('check_ls.usu_alta_id') }}</dt>
            <dd>{{ optional($checkL->user)->name }}</dd>
            <dt>{{ trans('check_ls.usu_mod_id') }}</dt>
            <dd>{{ optional($checkL->user)->name }}</dd>
            <dt>{{ trans('check_ls.created_at') }}</dt>
            <dd>{{ $checkL->created_at }}</dd>
            <dt>{{ trans('check_ls.updated_at') }}</dt>
            <dd>{{ $checkL->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection