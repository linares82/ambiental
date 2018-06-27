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
				<a href="{{ route('s_procedimientos.s_procedimiento.index') }}">{{ trans('s_procedimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('s_procedimientos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('s_procedimientos.s_procedimiento.destroy', $sProcedimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('s_procedimientos.s_procedimiento.index')
                    <a href="{{ route('s_procedimientos.s_procedimiento.index') }}" class="btn btn-primary" title="{{ trans('s_procedimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_procedimientos.s_procedimiento.create')
                    <a href="{{ route('s_procedimientos.s_procedimiento.create') }}" class="btn btn-success" title="{{ trans('s_procedimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_procedimientos.s_procedimiento.edit')
                    <a href="{{ route('s_procedimientos.s_procedimiento.edit', $sProcedimiento->id ) }}" class="btn btn-primary" title="{{ trans('s_procedimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_procedimientos.s_procedimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('s_procedimientos.delete') }}" onclick="return confirm(&quot;{{ trans('s_procedimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('s_procedimientos.tpo_procedimiento_id') }}</dt>
            <dd>{{ optional($sProcedimiento->csTpoProcedimiento)->tpo_procedimiento }}</dd>
            <dt>{{ trans('s_procedimientos.tpo_doc_id') }}</dt>
            <dd>{{ optional($sProcedimiento->csTpoDoc)->tpo_doc }}</dd>
            <dt>{{ trans('s_procedimientos.descripcion') }}</dt>
            <dd>{{ $sProcedimiento->descripcion }}</dd>
            <dt>{{ trans('s_procedimientos.archivo') }}</dt>
            <dd>{{ $sProcedimiento->archivo }}</dd>
            <dt>{{ trans('s_procedimientos.aviso') }}</dt>
            <dd>{{ optional($sProcedimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('s_procedimientos.dias_aviso') }}</dt>
            <dd>{{ $sProcedimiento->dias_aviso }}</dd>
            <dt>{{ trans('s_procedimientos.responsable_id') }}</dt>
            <dd>{{ optional($sProcedimiento->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('s_procedimientos.fec_fin_vigencia') }}</dt>
            <dd>{{ $sProcedimiento->fec_fin_vigencia }}</dd>
            <dt>{{ trans('s_procedimientos.estatus_id') }}</dt>
            <dd>{{ optional($sProcedimiento->sEstatusProcedimiento)->id }}</dd>
            <dt>{{ trans('s_procedimientos.entity_id') }}</dt>
            <dd>{{ optional($sProcedimiento->entity)->rzon_social }}</dd>
            <dt>{{ trans('s_procedimientos.usu_alta_id') }}</dt>
            <dd>{{ optional($sProcedimiento->user)->name }}</dd>
            <dt>{{ trans('s_procedimientos.usu_mod_id') }}</dt>
            <dd>{{ optional($sProcedimiento->user)->name }}</dd>
            <dt>{{ trans('s_procedimientos.created_at') }}</dt>
            <dd>{{ $sProcedimiento->created_at }}</dd>
            <dt>{{ trans('s_procedimientos.updated_at') }}</dt>
            <dd>{{ $sProcedimiento->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection