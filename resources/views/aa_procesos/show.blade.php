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
				<a href="{{ route('aa_procesos.aa_proceso.index') }}">{{ trans('aa_procesos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('aa_procesos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('aa_procesos.aa_proceso.destroy', $aaProceso->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('aa_procesos.aa_proceso.index')
                    <a href="{{ route('aa_procesos.aa_proceso.index') }}" class="btn btn-primary" title="{{ trans('aa_procesos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_procesos.aa_proceso.create')
                    <a href="{{ route('aa_procesos.aa_proceso.create') }}" class="btn btn-success" title="{{ trans('aa_procesos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_procesos.aa_proceso.edit')
                    <a href="{{ route('aa_procesos.aa_proceso.edit', $aaProceso->id ) }}" class="btn btn-primary" title="{{ trans('aa_procesos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_procesos.aa_proceso.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('aa_procesos.delete') }}" onclick="return confirm(&quot;{{ trans('aa_procesos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('aa_procesos.proceso') }}</dt>
            <dd>{{ $aaProceso->proceso }}</dd>
            <dt>{{ trans('aa_procesos.detalle') }}</dt>
            <dd>{{ $aaProceso->detalle }}</dd>
            <dt>{{ trans('aa_procesos.usu_alta_id') }}</dt>
            <dd>{{ optional($aaProceso->user)->name }}</dd>
            <dt>{{ trans('aa_procesos.usu_mod_id') }}</dt>
            <dd>{{ optional($aaProceso->user)->name }}</dd>
            <dt>{{ trans('aa_procesos.created_at') }}</dt>
            <dd>{{ $aaProceso->created_at }}</dd>
            <dt>{{ trans('aa_procesos.updated_at') }}</dt>
            <dd>{{ $aaProceso->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection