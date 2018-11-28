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
				<a href="{{ route('s_documentos_leyes.s_documentos_leye.index') }}">{{ trans('s_documentos_leyes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('s_documentos_leyes.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('s_documentos_leyes.s_documentos_leye.destroy', $sDocumentosLeye->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('s_documentos_leyes.s_documentos_leye.index')
                    <a href="{{ route('s_documentos_leyes.s_documentos_leye.index') }}" class="btn btn-primary" title="{{ trans('s_documentos_leyes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_documentos_leyes.s_documentos_leye.create')
                    <a href="{{ route('s_documentos_leyes.s_documentos_leye.create') }}" class="btn btn-success" title="{{ trans('s_documentos_leyes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_documentos_leyes.s_documentos_leye.edit')
                    <a href="{{ route('s_documentos_leyes.s_documentos_leye.edit', $sDocumentosLeye->id ) }}" class="btn btn-primary" title="{{ trans('s_documentos_leyes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_documentos_leyes.s_documentos_leye.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('s_documentos_leyes.delete') }}" onclick="return confirm(&quot;{{ trans('s_documentos_leyes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('s_documentos_leyes.documento_id') }}</dt>
            <dd>{{ optional($sDocumentosLeye->csCatDoc)->cat_doc }}</dd>
            <dt>{{ trans('s_documentos_leyes.descripcion') }}</dt>
            <dd>{{ $sDocumentosLeye->descripcion }}</dd>
            <dt>{{ trans('s_documentos_leyes.fec_inicio_vigencia') }}</dt>
            <dd>{{ $sDocumentosLeye->fec_inicio_vigencia }}</dd>
            <dt>{{ trans('s_documentos_leyes.fec_fin_vigencia') }}</dt>
            <dd>{{ $sDocumentosLeye->fec_fin_vigencia }}</dd>
            <dt>{{ trans('s_documentos_leyes.aviso') }}</dt>
            <dd>{{ optional($sDocumentosLeye->bnd)->bnd }}</dd>
            <dt>{{ trans('s_documentos_leyes.dias_aviso') }}</dt>
            <dd>{{ $sDocumentosLeye->dias_aviso }}</dd>
            <dt>{{ trans('s_documentos_leyes.entity_id') }}</dt>
            <dd>{{ optional($sDocumentosLeye->entity)->rzon_social }}</dd>
            <dt>{{ trans('s_documentos_leyes.activo') }}</dt>
            <dd>{{ $sDocumentosLeye->activo }}</dd>
            <dt>{{ trans('s_documentos_leyes.usu_alta_id') }}</dt>
            <dd>{{ optional($sDocumentosLeye->user)->name }}</dd>
            <dt>{{ trans('s_documentos_leyes.usu_mod_id') }}</dt>
            <dd>{{ optional($sDocumentosLeye->user)->name }}</dd>
            <dt>{{ trans('s_documentos_leyes.created_at') }}</dt>
            <dd>{{ $sDocumentosLeye->created_at }}</dd>
            <dt>{{ trans('s_documentos_leyes.updated_at') }}</dt>
            <dd>{{ $sDocumentosLeye->updated_at }}</dd>
            <dt>{{ trans('s_documentos_leyes.deleted_at') }}</dt>
            <dd>{{ $sDocumentosLeye->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection