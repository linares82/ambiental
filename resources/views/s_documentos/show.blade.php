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
				<a href="{{ route('s_documentos.s_documento.index') }}">{{ trans('s_documentos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('s_documentos.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('s_documentos.s_documento.destroy', $sDocumento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('s_documentos.s_documento.index')
                    <a href="{{ route('s_documentos.s_documento.index') }}" class="btn btn-primary" title="{{ trans('s_documentos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_documentos.s_documento.create')
                    <a href="{{ route('s_documentos.s_documento.create') }}" class="btn btn-success" title="{{ trans('s_documentos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_documentos.s_documento.edit')
                    <a href="{{ route('s_documentos.s_documento.edit', $sDocumento->id ) }}" class="btn btn-primary" title="{{ trans('s_documentos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_documentos.s_documento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('s_documentos.delete') }}" onclick="return confirm(&quot;{{ trans('s_documentos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('s_documentos.documento_id') }}</dt>
            <dd>{{ optional($sDocumento->csCatDoc)->cat_doc }}</dd>
            <dt>{{ trans('s_documentos.descripcion') }}</dt>
            <dd>{{ $sDocumento->descripcion }}</dd>
            <dt>{{ trans('s_documentos.fec_ini_vigencia') }}</dt>
            <dd>{{ $sDocumento->fec_ini_vigencia }}</dd>
            <dt>{{ trans('s_documentos.fec_fin_vigencia') }}</dt>
            <dd>{{ $sDocumento->fec_fin_vigencia }}</dd>
            <dt>{{ trans('s_documentos.aviso') }}</dt>
            <dd>{{ optional($sDocumento->bnd)->bnd }}</dd>
            <dt>{{ trans('s_documentos.dias_aviso') }}</dt>
            <dd>{{ $sDocumento->dias_aviso }}</dd>
            <dt>{{ trans('s_documentos.responsable_id') }}</dt>
            <dd>{{ optional($sDocumento->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('s_documentos.archivo') }}</dt>
            <dd>{{ $sDocumento->archivo }}</dd>
            <dt>{{ trans('s_documentos.observaciones') }}</dt>
            <dd>{{ $sDocumento->observaciones }}</dd>
            <dt>{{ trans('s_documentos.estatus_id') }}</dt>
            <dd>{{ optional($sDocumento->sEstatusProcedimiento)->estatus }}</dd>
            <dt>{{ trans('s_documentos.entity_id') }}</dt>
            <dd>{{ optional($sDocumento->entity)->rzon_social }}</dd>
            <dt>{{ trans('s_documentos.usu_alta_id') }}</dt>
            <dd>{{ optional($sDocumento->user)->name }}</dd>
            <dt>{{ trans('s_documentos.usu_mod_id') }}</dt>
            <dd>{{ optional($sDocumento->user)->name }}</dd>
            <dt>{{ trans('s_documentos.created_at') }}</dt>
            <dd>{{ $sDocumento->created_at }}</dd>
            <dt>{{ trans('s_documentos.updated_at') }}</dt>
            <dd>{{ $sDocumento->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection