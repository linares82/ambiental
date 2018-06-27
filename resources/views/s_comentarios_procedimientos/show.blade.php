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
				<a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.index') }}">{{ trans('s_comentarios_procedimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('s_comentarios_procedimientos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('s_comentarios_procedimientos.s_comentarios_procedimiento.destroy', $sComentariosProcedimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('s_comentarios_procedimientos.s_comentarios_procedimiento.index')
                    <a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.index') }}" class="btn btn-primary" title="{{ trans('s_comentarios_procedimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_procedimientos.s_comentarios_procedimiento.create')
                    <a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.create') }}" class="btn btn-success" title="{{ trans('s_comentarios_procedimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_procedimientos.s_comentarios_procedimiento.edit')
                    <a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.edit', $sComentariosProcedimiento->id ) }}" class="btn btn-primary" title="{{ trans('s_comentarios_procedimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_comentarios_procedimientos.s_comentarios_procedimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('s_comentarios_procedimientos.delete') }}" onclick="return confirm(&quot;{{ trans('s_comentarios_procedimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('s_comentarios_procedimientos.s_procedimiento_id') }}</dt>
            <dd>{{ optional($sComentariosProcedimiento->sProcedimiento)->descripcion }}</dd>
            <dt>{{ trans('s_comentarios_procedimientos.comentario') }}</dt>
            <dd>{{ $sComentariosProcedimiento->comentario }}</dd>
            <dt>{{ trans('s_comentarios_procedimientos.estatus_id') }}</dt>
            <dd>{{ optional($sComentariosProcedimiento->sEstatusProcedimiento)->estatus }}</dd>
            <dt>{{ trans('s_comentarios_procedimientos.usu_alta_id') }}</dt>
            <dd>{{ optional($sComentariosProcedimiento->user)->name }}</dd>
            <dt>{{ trans('s_comentarios_procedimientos.usu_mod_id') }}</dt>
            <dd>{{ optional($sComentariosProcedimiento->user)->name }}</dd>
            <dt>{{ trans('s_comentarios_procedimientos.created_at') }}</dt>
            <dd>{{ $sComentariosProcedimiento->created_at }}</dd>
            <dt>{{ trans('s_comentarios_procedimientos.updated_at') }}</dt>
            <dd>{{ $sComentariosProcedimiento->updated_at }}</dd>
            <dt>{{ trans('s_comentarios_procedimientos.deleted_at') }}</dt>
            <dd>{{ $sComentariosProcedimiento->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection