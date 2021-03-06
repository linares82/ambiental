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
				<a href="{{ route('cs_grupo_normas.cs_grupo_norma.index') }}">{{ trans('cs_grupo_normas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_grupo_normas.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_grupo_normas.cs_grupo_norma.destroy', $csGrupoNorma->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_grupo_normas.cs_grupo_norma.index')
                    <a href="{{ route('cs_grupo_normas.cs_grupo_norma.index') }}" class="btn btn-primary" title="{{ trans('cs_grupo_normas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_grupo_normas.cs_grupo_norma.create')
                    <a href="{{ route('cs_grupo_normas.cs_grupo_norma.create') }}" class="btn btn-success" title="{{ trans('cs_grupo_normas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_grupo_normas.cs_grupo_norma.edit')
                    <a href="{{ route('cs_grupo_normas.cs_grupo_norma.edit', $csGrupoNorma->id ) }}" class="btn btn-primary" title="{{ trans('cs_grupo_normas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_grupo_normas.cs_grupo_norma.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_grupo_normas.delete') }}" onclick="return confirm(&quot;{{ trans('cs_grupo_normas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_grupo_normas.grupo_norma') }}</dt>
            <dd>{{ $csGrupoNorma->grupo_norma }}</dd>
            <dt>{{ trans('cs_grupo_normas.usu_alta_id') }}</dt>
            <dd>{{ optional($csGrupoNorma->user)->name }}</dd>
            <dt>{{ trans('cs_grupo_normas.usu_mod_id') }}</dt>
            <dd>{{ optional($csGrupoNorma->user)->name }}</dd>
            <dt>{{ trans('cs_grupo_normas.created_at') }}</dt>
            <dd>{{ $csGrupoNorma->created_at }}</dd>
            <dt>{{ trans('cs_grupo_normas.updated_at') }}</dt>
            <dd>{{ $csGrupoNorma->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection