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
				<a href="{{ route('s_comentarios_documentos.s_comentarios_documento.index') }}">{{ trans('s_comentarios_documentos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('s_comentarios_documentos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('s_comentarios_documentos.s_comentarios_documento.destroy', $sComentariosDocumento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('s_comentarios_documentos.s_comentarios_documento.index')
                    <a href="{{ route('s_comentarios_documentos.s_comentarios_documento.index') }}" class="btn btn-primary" title="{{ trans('s_comentarios_documentos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_documentos.s_comentarios_documento.create')
                    <a href="{{ route('s_comentarios_documentos.s_comentarios_documento.create') }}" class="btn btn-success" title="{{ trans('s_comentarios_documentos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_documentos.s_comentarios_documento.edit')
                    <a href="{{ route('s_comentarios_documentos.s_comentarios_documento.edit', $sComentariosDocumento->id ) }}" class="btn btn-primary" title="{{ trans('s_comentarios_documentos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_documentos.s_comentarios_documento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('s_comentarios_documentos.delete') }}" onclick="return confirm(&quot;{{ trans('s_comentarios_documentos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('s_comentarios_documentos.s_documento_id') }}</dt>
            <dd>{{ optional($sComentariosDocumento->sDocumento)->descripcion }}</dd>
            <dt>{{ trans('s_comentarios_documentos.comentario') }}</dt>
            <dd>{{ $sComentariosDocumento->comentario }}</dd>
            <dt>{{ trans('s_comentarios_documentos.estatus_id') }}</dt>
            <dd>{{ optional($sComentariosDocumento->sEstatusProcedimiento)->estatus }}</dd>
            <dt>{{ trans('s_comentarios_documentos.usu_alta_id') }}</dt>
            <dd>{{ optional($sComentariosDocumento->user)->name }}</dd>
            <dt>{{ trans('s_comentarios_documentos.usu_mod_id') }}</dt>
            <dd>{{ optional($sComentariosDocumento->user)->name }}</dd>
            <dt>{{ trans('s_comentarios_documentos.created_at') }}</dt>
            <dd>{{ $sComentariosDocumento->created_at }}</dd>
            <dt>{{ trans('s_comentarios_documentos.updated_at') }}</dt>
            <dd>{{ $sComentariosDocumento->updated_at }}</dd>
            <dt>{{ trans('s_comentarios_documentos.deleted_at') }}</dt>
            <dd>{{ $sComentariosDocumento->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection