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
				<a href="{{ route('a_comentarios_archivos.a_comentarios_archivo.index') }}">{{ trans('a_comentarios_archivos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('a_comentarios_archivos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_comentarios_archivos.a_comentarios_archivo.destroy', $aComentariosArchivo->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_comentarios_archivos.a_comentarios_archivo.index')
                    <a href="{{ route('a_comentarios_archivos.a_comentarios_archivo.index') }}" class="btn btn-primary" title="{{ trans('a_comentarios_archivos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_comentarios_archivos.a_comentarios_archivo.create')
                    <a href="{{ route('a_comentarios_archivos.a_comentarios_archivo.create') }}" class="btn btn-success" title="{{ trans('a_comentarios_archivos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_comentarios_archivos.a_comentarios_archivo.edit')
                    <a href="{{ route('a_comentarios_archivos.a_comentarios_archivo.edit', $aComentariosArchivo->id ) }}" class="btn btn-primary" title="{{ trans('a_comentarios_archivos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_comentarios_archivos.a_comentarios_archivo.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_comentarios_archivos.delete') }}" onclick="return confirm(&quot;{{ trans('a_comentarios_archivos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_comentarios_archivos.a_archivo_id') }}</dt>
            <dd>{{ optional($aComentariosArchivo->aArchivo)->descripcion }}</dd>
            <dt>{{ trans('a_comentarios_archivos.comentario') }}</dt>
            <dd>{{ $aComentariosArchivo->comentario }}</dd>
            <dt>{{ trans('a_comentarios_archivos.a_st_archivo_id') }}</dt>
            <dd>{{ optional($aComentariosArchivo->aStArchivo)->estatus }}</dd>
            <dt>{{ trans('a_comentarios_archivos.usu_alta_id') }}</dt>
            <dd>{{ optional($aComentariosArchivo->user)->name }}</dd>
            <dt>{{ trans('a_comentarios_archivos.usu_mod_id') }}</dt>
            <dd>{{ optional($aComentariosArchivo->user)->name }}</dd>
            <dt>{{ trans('a_comentarios_archivos.created_at') }}</dt>
            <dd>{{ $aComentariosArchivo->created_at }}</dd>
            <dt>{{ trans('a_comentarios_archivos.updated_at') }}</dt>
            <dd>{{ $aComentariosArchivo->updated_at }}</dd>
            <dt>{{ trans('a_comentarios_archivos.deleted_at') }}</dt>
            <dd>{{ $aComentariosArchivo->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection