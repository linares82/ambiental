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
				<a href="{{ route('a_comentarios_rrs.a_comentarios_rrs.index') }}">{{ trans('a_comentarios_rrs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('a_comentarios_rrs.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_comentarios_rrs.a_comentarios_rrs.destroy', $aComentariosRrs->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_comentarios_rrs.a_comentarios_rrs.index')
                    <a href="{{ route('a_comentarios_rrs.a_comentarios_rrs.index') }}" class="btn btn-primary" title="{{ trans('a_comentarios_rrs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_comentarios_rrs.a_comentarios_rrs.create')
                    <a href="{{ route('a_comentarios_rrs.a_comentarios_rrs.create') }}" class="btn btn-success" title="{{ trans('a_comentarios_rrs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_comentarios_rrs.a_comentarios_rrs.edit')
                    <a href="{{ route('a_comentarios_rrs.a_comentarios_rrs.edit', $aComentariosRrs->id ) }}" class="btn btn-primary" title="{{ trans('a_comentarios_rrs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_comentarios_rrs.a_comentarios_rrs.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_comentarios_rrs.delete') }}" onclick="return confirm(&quot;{{ trans('a_comentarios_rrs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_comentarios_rrs.a_rr_id') }}</dt>
            <dd>{{ optional($aComentariosRrs->aRrAmbientale)->descripcion }}</dd>
            <dt>{{ trans('a_comentarios_rrs.comentario') }}</dt>
            <dd>{{ $aComentariosRrs->comentario }}</dd>
            <dt>{{ trans('a_comentarios_rrs.a_st_rr_id') }}</dt>
            <dd>{{ optional($aComentariosRrs->aStRr)->id }}</dd>
            <dt>{{ trans('a_comentarios_rrs.usu_alta_id') }}</dt>
            <dd>{{ optional($aComentariosRrs->user)->name }}</dd>
            <dt>{{ trans('a_comentarios_rrs.usu_mod_id') }}</dt>
            <dd>{{ optional($aComentariosRrs->user)->name }}</dd>
            <dt>{{ trans('a_comentarios_rrs.created_at') }}</dt>
            <dd>{{ $aComentariosRrs->created_at }}</dd>
            <dt>{{ trans('a_comentarios_rrs.updated_at') }}</dt>
            <dd>{{ $aComentariosRrs->updated_at }}</dd>
            <dt>{{ trans('a_comentarios_rrs.deleted_at') }}</dt>
            <dd>{{ $aComentariosRrs->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection