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
				<a href="{{ route('a_archivos.a_archivo.index') }}">{{ trans('a_archivos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('a_archivos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_archivos.a_archivo.destroy', $aArchivo->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_archivos.a_archivo.index')
                    <a href="{{ route('a_archivos.a_archivo.index') }}" class="btn btn-primary" title="{{ trans('a_archivos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_archivos.a_archivo.create')
                    <a href="{{ route('a_archivos.a_archivo.create') }}" class="btn btn-success" title="{{ trans('a_archivos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_archivos.a_archivo.edit')
                    <a href="{{ route('a_archivos.a_archivo.edit', $aArchivo->id ) }}" class="btn btn-primary" title="{{ trans('a_archivos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_archivos.a_archivo.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_archivos.delete') }}" onclick="return confirm(&quot;{{ trans('a_archivos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_archivos.documento_id') }}</dt>
            <dd>{{ optional($aArchivo->caCaDoc)->doc }}</dd>
            <dt>{{ trans('a_archivos.descripcion') }}</dt>
            <dd>{{ $aArchivo->descripcion }}</dd>
            <dt>{{ trans('a_archivos.archivo') }}</dt>
            <dd>{{ $aArchivo->archivo }}</dd>
            <dt>{{ trans('a_archivos.fec_ini_vigencia') }}</dt>
            <dd>{{ $aArchivo->fec_ini_vigencia }}</dd>
            <dt>{{ trans('a_archivos.fec_fin_vigencia') }}</dt>
            <dd>{{ $aArchivo->fec_fin_vigencia }}</dd>
            <dt>{{ trans('a_archivos.aviso') }}</dt>
            <dd>{{ optional($aArchivo->bnd)->bnd }}</dd>
            <dt>{{ trans('a_archivos.dias_aviso') }}</dt>
            <dd>{{ $aArchivo->dias_aviso }}</dd>
            <dt>{{ trans('a_archivos.responsable_id') }}</dt>
            <dd>{{ optional($aArchivo->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('a_archivos.obs') }}</dt>
            <dd>{{ $aArchivo->obs }}</dd>
            <dt>{{ trans('a_archivos.st_archivo_id') }}</dt>
            <dd>{{ optional($aArchivo->aStArchivo)->estatus }}</dd>
            <dt>{{ trans('a_archivos.entity_id') }}</dt>
            <dd>{{ optional($aArchivo->entity)->rzon_social }}</dd>
            <dt>{{ trans('a_archivos.usu_alta_id') }}</dt>
            <dd>{{ optional($aArchivo->user)->name }}</dd>
            <dt>{{ trans('a_archivos.usu_mod_id') }}</dt>
            <dd>{{ optional($aArchivo->user)->name }}</dd>
            <dt>{{ trans('a_archivos.created_at') }}</dt>
            <dd>{{ $aArchivo->created_at }}</dd>
            <dt>{{ trans('a_archivos.updated_at') }}</dt>
            <dd>{{ $aArchivo->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection