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
				<a href="{{ route('files_a_archivos.files_a_archivo.index') }}">{{ trans('files_a_archivos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('files_a_archivos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_a_archivos.files_a_archivo.destroy', $filesAArchivo->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_a_archivos.files_a_archivo.index')
                    <a href="{{ route('files_a_archivos.files_a_archivo.index') }}" class="btn btn-primary" title="{{ trans('files_a_archivos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_archivos.files_a_archivo.create')
                    <a href="{{ route('files_a_archivos.files_a_archivo.create') }}" class="btn btn-success" title="{{ trans('files_a_archivos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_archivos.files_a_archivo.edit')
                    <a href="{{ route('files_a_archivos.files_a_archivo.edit', $filesAArchivo->id ) }}" class="btn btn-primary" title="{{ trans('files_a_archivos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_archivos.files_a_archivo.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_a_archivos.delete') }}" onclick="return confirm(&quot;{{ trans('files_a_archivos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_a_archivos.a_archivo_id') }}</dt>
            <dd>{{ optional($filesAArchivo->aArchivo)->descripcion }}</dd>
            <dt>{{ trans('files_a_archivos.documento') }}</dt>
            <dd>{{ $filesAArchivo->documento }}</dd>
            <dt>{{ trans('files_a_archivos.archivo') }}</dt>
            <dd>{{ $filesAArchivo->archivo }}</dd>
            <dt>{{ trans('files_a_archivos.usu_alta_id') }}</dt>
            <dd>{{ optional($filesAArchivo->user)->name }}</dd>
            <dt>{{ trans('files_a_archivos.usu_mod_id') }}</dt>
            <dd>{{ optional($filesAArchivo->user)->name }}</dd>
            <dt>{{ trans('files_a_archivos.created_at') }}</dt>
            <dd>{{ $filesAArchivo->created_at }}</dd>
            <dt>{{ trans('files_a_archivos.updated_at') }}</dt>
            <dd>{{ $filesAArchivo->updated_at }}</dd>
            <dt>{{ trans('files_a_archivos.deleted_at') }}</dt>
            <dd>{{ $filesAArchivo->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection