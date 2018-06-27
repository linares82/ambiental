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
				<a href="{{ route('s_comentarios_registros.s_comentarios_registro.index') }}">{{ trans('s_comentarios_registros.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('s_comentarios_registros.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('s_comentarios_registros.s_comentarios_registro.destroy', $sComentariosRegistro->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('s_comentarios_registros.s_comentarios_registro.index')
                    <a href="{{ route('s_comentarios_registros.s_comentarios_registro.index') }}" class="btn btn-primary" title="{{ trans('s_comentarios_registros.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_registros.s_comentarios_registro.create')
                    <a href="{{ route('s_comentarios_registros.s_comentarios_registro.create') }}" class="btn btn-success" title="{{ trans('s_comentarios_registros.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_registros.s_comentarios_registro.edit')
                    <a href="{{ route('s_comentarios_registros.s_comentarios_registro.edit', $sComentariosRegistro->id ) }}" class="btn btn-primary" title="{{ trans('s_comentarios_registros.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_registros.s_comentarios_registro.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('s_comentarios_registros.delete') }}" onclick="return confirm(&quot;{{ trans('s_comentarios_registros.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('s_comentarios_registros.s_registros_id') }}</dt>
            <dd>{{ optional($sComentariosRegistro->sRegistro)->detalle }}</dd>
            <dt>{{ trans('s_comentarios_registros.comentario') }}</dt>
            <dd>{{ $sComentariosRegistro->comentario }}</dd>
            <dt>{{ trans('s_comentarios_registros.estatus_id') }}</dt>
            <dd>{{ optional($sComentariosRegistro->sEstatusProcedimiento)->estatus }}</dd>
            <dt>{{ trans('s_comentarios_registros.usu_alta_id') }}</dt>
            <dd>{{ optional($sComentariosRegistro->user)->name }}</dd>
            <dt>{{ trans('s_comentarios_registros.usu_mod_id') }}</dt>
            <dd>{{ optional($sComentariosRegistro->user)->name }}</dd>
            <dt>{{ trans('s_comentarios_registros.created_at') }}</dt>
            <dd>{{ $sComentariosRegistro->created_at }}</dd>
            <dt>{{ trans('s_comentarios_registros.updated_at') }}</dt>
            <dd>{{ $sComentariosRegistro->updated_at }}</dd>
            <dt>{{ trans('s_comentarios_registros.deleted_at') }}</dt>
            <dd>{{ $sComentariosRegistro->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection