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
				<a href="{{ route('files_s_documentos.files_s_documento.index') }}">{{ trans('files_s_documentos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('files_s_documentos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_s_documentos.files_s_documento.destroy', $filesSDocumento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_s_documentos.files_s_documento.index')
                    <a href="{{ route('files_s_documentos.files_s_documento.index') }}" class="btn btn-primary" title="{{ trans('files_s_documentos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_documentos.files_s_documento.create')
                    <a href="{{ route('files_s_documentos.files_s_documento.create') }}" class="btn btn-success" title="{{ trans('files_s_documentos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_documentos.files_s_documento.edit')
                    <a href="{{ route('files_s_documentos.files_s_documento.edit', $filesSDocumento->id ) }}" class="btn btn-primary" title="{{ trans('files_s_documentos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_documentos.files_s_documento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_s_documentos.delete') }}" onclick="return confirm(&quot;{{ trans('files_s_documentos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_s_documentos.file_path') }}</dt>
            <dd>{{ $filesSDocumento->file_path }}</dd>
            <dt>{{ trans('files_s_documentos.descripcion') }}</dt>
            <dd>{{ $filesSDocumento->descripcion }}</dd>
            <dt>{{ trans('files_s_documentos.s_documento_id') }}</dt>
            <dd>{{ optional($filesSDocumento->sDocumento)->descripcion }}</dd>
            <dt>{{ trans('files_s_documentos.created_at') }}</dt>
            <dd>{{ $filesSDocumento->created_at }}</dd>
            <dt>{{ trans('files_s_documentos.updated_at') }}</dt>
            <dd>{{ $filesSDocumento->updated_at }}</dd>
            <dt>{{ trans('files_s_documentos.deleted_at') }}</dt>
            <dd>{{ $filesSDocumento->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection