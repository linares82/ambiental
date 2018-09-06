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
				<a href="{{ route('files_cs_normas.files_cs_norma.index') }}">{{ trans('files_cs_normas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('files_cs_normas.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_cs_normas.files_cs_norma.destroy', $filesCsNorma->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_cs_normas.files_cs_norma.index')
                    <a href="{{ route('files_cs_normas.files_cs_norma.index') }}" class="btn btn-primary" title="{{ trans('files_cs_normas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_cs_normas.files_cs_norma.create')
                    <a href="{{ route('files_cs_normas.files_cs_norma.create') }}" class="btn btn-success" title="{{ trans('files_cs_normas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_cs_normas.files_cs_norma.edit')
                    <a href="{{ route('files_cs_normas.files_cs_norma.edit', $filesCsNorma->id ) }}" class="btn btn-primary" title="{{ trans('files_cs_normas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_cs_normas.files_cs_norma.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_cs_normas.delete') }}" onclick="return confirm(&quot;{{ trans('files_cs_normas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_cs_normas.cs_norma_id') }}</dt>
            <dd>{{ optional($filesCsNorma->csNorma)->norma }}</dd>
            <dt>{{ trans('files_cs_normas.documento') }}</dt>
            <dd>{{ $filesCsNorma->documento }}</dd>
            <dt>{{ trans('files_cs_normas.archivo') }}</dt>
            <dd>{{ $filesCsNorma->archivo }}</dd>
            <dt>{{ trans('files_cs_normas.usu_alta_id') }}</dt>
            <dd>{{ optional($filesCsNorma->user)->name }}</dd>
            <dt>{{ trans('files_cs_normas.usu_mod_id') }}</dt>
            <dd>{{ optional($filesCsNorma->user)->name }}</dd>
            <dt>{{ trans('files_cs_normas.created_at') }}</dt>
            <dd>{{ $filesCsNorma->created_at }}</dd>
            <dt>{{ trans('files_cs_normas.updated_at') }}</dt>
            <dd>{{ $filesCsNorma->updated_at }}</dd>
            <dt>{{ trans('files_cs_normas.deleted_at') }}</dt>
            <dd>{{ $filesCsNorma->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection