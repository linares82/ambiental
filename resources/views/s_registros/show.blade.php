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
				<a href="{{ route('s_registros.s_registro.index') }}">{{ trans('s_registros.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('s_registros.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('s_registros.s_registro.destroy', $sRegistro->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('s_registros.s_registro.index')
                    <a href="{{ route('s_registros.s_registro.index') }}" class="btn btn-primary" title="{{ trans('s_registros.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_registros.s_registro.create')
                    <a href="{{ route('s_registros.s_registro.create') }}" class="btn btn-success" title="{{ trans('s_registros.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_registros.s_registro.edit')
                    <a href="{{ route('s_registros.s_registro.edit', $sRegistro->id ) }}" class="btn btn-primary" title="{{ trans('s_registros.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_registros.s_registro.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('s_registros.delete') }}" onclick="return confirm(&quot;{{ trans('s_registros.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('s_registros.grupo_id') }}</dt>
            <dd>{{ optional($sRegistro->csGrupoNorma)->grupo_norma }}</dd>
            <dt>{{ trans('s_registros.norma_id') }}</dt>
            <dd>{{ optional($sRegistro->csNorma)->norma }}</dd>
            <dt>{{ trans('s_registros.elemento_id') }}</dt>
            <dd>{{ optional($sRegistro->csElementosInspeccion)->elemento }}</dd>
            <dt>{{ trans('s_registros.detalle') }}</dt>
            <dd>{{ $sRegistro->detalle }}</dd>
            <dt>{{ trans('s_registros.fec_registro') }}</dt>
            <dd>{{ $sRegistro->fec_registro }}</dd>
            <dt>{{ trans('s_registros.aviso') }}</dt>
            <dd>{{ optional($sRegistro->bnd)->bnd }}</dd>
            <dt>{{ trans('s_registros.dias_aviso') }}</dt>
            <dd>{{ $sRegistro->dias_aviso }}</dd>
            <dt>{{ trans('s_registros.responsable_id') }}</dt>
            <dd>{{ optional($sRegistro->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('s_registros.fec_fin_vigencia') }}</dt>
            <dd>{{ $sRegistro->fec_fin_vigencia }}</dd>
            <dt>{{ trans('s_registros.archivo') }}</dt>
            <dd>{{ $sRegistro->archivo }}</dd>
            <dt>{{ trans('s_registros.estatus_id') }}</dt>
            <dd>{{ optional($sRegistro->sEstatusProcedimiento)->estatus }}</dd>
            <dt>{{ trans('s_registros.entity_id') }}</dt>
            <dd>{{ optional($sRegistro->entity)->rzon_social }}</dd>
            <dt>{{ trans('s_registros.usu_alta_id') }}</dt>
            <dd>{{ optional($sRegistro->user)->name }}</dd>
            <dt>{{ trans('s_registros.usu_mod_id') }}</dt>
            <dd>{{ optional($sRegistro->user)->name }}</dd>
            <dt>{{ trans('s_registros.created_at') }}</dt>
            <dd>{{ $sRegistro->created_at }}</dd>
            <dt>{{ trans('s_registros.updated_at') }}</dt>
            <dd>{{ $sRegistro->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection