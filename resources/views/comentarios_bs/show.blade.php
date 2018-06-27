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
				<a href="{{ route('comentarios_bs.comentarios_b.index') }}">{{ trans('comentarios_bs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('comentarios_bs.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('comentarios_bs.comentarios_b.destroy', $comentariosB->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('comentarios_bs.comentarios_b.index')
                    <a href="{{ route('comentarios_bs.comentarios_b.index') }}" class="btn btn-primary" title="{{ trans('comentarios_bs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('comentarios_bs.comentarios_b.create')
                    <a href="{{ route('comentarios_bs.comentarios_b.create') }}" class="btn btn-success" title="{{ trans('comentarios_bs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('comentarios_bs.comentarios_b.edit')
                    <a href="{{ route('comentarios_bs.comentarios_b.edit', $comentariosB->id ) }}" class="btn btn-primary" title="{{ trans('comentarios_bs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('comentarios_bs.comentarios_b.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('comentarios_bs.delete') }}" onclick="return confirm(&quot;{{ trans('comentarios_bs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('comentarios_bs.bitacora_seguridad_id') }}</dt>
            <dd>{{ optional($comentariosB->bitacoraSeguridad)->fecha }}</dd>
            <dt>{{ trans('comentarios_bs.comentario') }}</dt>
            <dd>{{ $comentariosB->comentario }}</dd>
            <dt>{{ trans('comentarios_bs.costo') }}</dt>
            <dd>{{ $comentariosB->costo }}</dd>
            <dt>{{ trans('comentarios_bs.estatus_id') }}</dt>
            <dd>{{ optional($comentariosB->sStB)->estatus }}</dd>
            <dt>{{ trans('comentarios_bs.usu_alta_id') }}</dt>
            <dd>{{ optional($comentariosB->user)->name }}</dd>
            <dt>{{ trans('comentarios_bs.usu_mod_id') }}</dt>
            <dd>{{ optional($comentariosB->user)->name }}</dd>
            <dt>{{ trans('comentarios_bs.created_at') }}</dt>
            <dd>{{ $comentariosB->created_at }}</dd>
            <dt>{{ trans('comentarios_bs.updated_at') }}</dt>
            <dd>{{ $comentariosB->updated_at }}</dd>
            <dt>{{ trans('comentarios_bs.deleted_at') }}</dt>
            <dd>{{ $comentariosB->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection