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
				<a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.index') }}">{{ trans('rev_requisitos_lns.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('rev_requisitos_lns.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('rev_requisitos_lns.rev_requisitos_ln.destroy', $revRequisitosLn->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.index')
                    <a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.index') }}" class="btn btn-primary" title="{{ trans('rev_requisitos_lns.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.create')
                    <a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.create') }}" class="btn btn-success" title="{{ trans('rev_requisitos_lns.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.edit')
                    <a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.edit', $revRequisitosLn->id ) }}" class="btn btn-primary" title="{{ trans('rev_requisitos_lns.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('rev_requisitos_lns.delete') }}" onclick="return confirm(&quot;{{ trans('rev_requisitos_lns.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('rev_requisitos_lns.rev_requisitos_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->revRequisito)->anio }}</dd>
            <dt>{{ trans('rev_requisitos_lns.impacto_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->aaImpacto)->impacto }}</dd>
            <dt>{{ trans('rev_requisitos_lns.condicion_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->condicione)->condicion }}</dd>
            <dt>{{ trans('rev_requisitos_lns.area_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->area)->area }}</dd>
            <dt>{{ trans('rev_requisitos_lns.norma') }}</dt>
            <dd>{{ $revRequisitosLn->norma }}</dd>
            <dt>{{ trans('rev_requisitos_lns.estatus_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->estatusCondicione)->id }}</dd>
            <dt>{{ trans('rev_requisitos_lns.importancia_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->importancium)->id }}</dd>
            <dt>{{ trans('rev_requisitos_lns.responsable_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('rev_requisitos_lns.dias_advertencia1') }}</dt>
            <dd>{{ $revRequisitosLn->dias_advertencia1 }}</dd>
            <dt>{{ trans('rev_requisitos_lns.dias_advertencia2') }}</dt>
            <dd>{{ $revRequisitosLn->dias_advertencia2 }}</dd>
            <dt>{{ trans('rev_requisitos_lns.dias_advertencia3') }}</dt>
            <dd>{{ $revRequisitosLn->dias_advertencia3 }}</dd>
            <dt>{{ trans('rev_requisitos_lns.fec_cumplimiento') }}</dt>
            <dd>{{ $revRequisitosLn->fec_cumplimiento }}</dd>
            <dt>{{ trans('rev_requisitos_lns.observaciones') }}</dt>
            <dd>{{ $revRequisitosLn->observaciones }}</dd>
            <dt>{{ trans('rev_requisitos_lns.usu_alta_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->user)->name }}</dd>
            <dt>{{ trans('rev_requisitos_lns.usu_mod_id') }}</dt>
            <dd>{{ optional($revRequisitosLn->user)->name }}</dd>
            <dt>{{ trans('rev_requisitos_lns.created_at') }}</dt>
            <dd>{{ $revRequisitosLn->created_at }}</dd>
            <dt>{{ trans('rev_requisitos_lns.updated_at') }}</dt>
            <dd>{{ $revRequisitosLn->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection