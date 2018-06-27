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
				<a href="{{ route('a_procedimientos.a_procedimiento.index') }}">{{ trans('a_procedimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('a_procedimientos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_procedimientos.a_procedimiento.destroy', $aProcedimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_procedimientos.a_procedimiento.index')
                    <a href="{{ route('a_procedimientos.a_procedimiento.index') }}" class="btn btn-primary" title="{{ trans('a_procedimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_procedimientos.a_procedimiento.create')
                    <a href="{{ route('a_procedimientos.a_procedimiento.create') }}" class="btn btn-success" title="{{ trans('a_procedimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_procedimientos.a_procedimiento.edit')
                    <a href="{{ route('a_procedimientos.a_procedimiento.edit', $aProcedimiento->id ) }}" class="btn btn-primary" title="{{ trans('a_procedimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_procedimientos.a_procedimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_procedimientos.delete') }}" onclick="return confirm(&quot;{{ trans('a_procedimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_procedimientos.procedimiento_id') }}</dt>
            <dd>{{ optional($aProcedimiento->caProcedimiento)->procedimiento }}</dd>
            <dt>{{ trans('a_procedimientos.descripcion') }}</dt>
            <dd>{{ $aProcedimiento->descripcion }}</dd>
            <dt>{{ trans('a_procedimientos.fec_ini_vigencia') }}</dt>
            <dd>{{ $aProcedimiento->fec_ini_vigencia }}</dd>
            <dt>{{ trans('a_procedimientos.fec_fin_vigencia') }}</dt>
            <dd>{{ $aProcedimiento->fec_fin_vigencia }}</dd>
            <dt>{{ trans('a_procedimientos.archivo') }}</dt>
            <dd>{{ $aProcedimiento->archivo }}</dd>
            <dt>{{ trans('a_procedimientos.aviso') }}</dt>
            <dd>{{ optional($aProcedimiento->bnd)->bnd }}</dd>
            <dt>{{ trans('a_procedimientos.dias_aviso') }}</dt>
            <dd>{{ $aProcedimiento->dias_aviso }}</dd>
            <dt>{{ trans('a_procedimientos.responsable_id') }}</dt>
            <dd>{{ optional($aProcedimiento->empleado)->nombre }}</dd>
            <dt>{{ trans('a_procedimientos.obs') }}</dt>
            <dd>{{ $aProcedimiento->obs }}</dd>
            <dt>{{ trans('a_procedimientos.st_archivo_id') }}</dt>
            <dd>{{ optional($aProcedimiento->aStArchivo)->estatus }}</dd>
            <dt>{{ trans('a_procedimientos.entity_id') }}</dt>
            <dd>{{ optional($aProcedimiento->entity)->rzon_social }}</dd>
            <dt>{{ trans('a_procedimientos.usu_alta_id') }}</dt>
            <dd>{{ optional($aProcedimiento->user)->name }}</dd>
            <dt>{{ trans('a_procedimientos.usu_mod_id') }}</dt>
            <dd>{{ optional($aProcedimiento->user)->name }}</dd>
            <dt>{{ trans('a_procedimientos.created_at') }}</dt>
            <dd>{{ $aProcedimiento->created_at }}</dd>
            <dt>{{ trans('a_procedimientos.updated_at') }}</dt>
            <dd>{{ $aProcedimiento->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection