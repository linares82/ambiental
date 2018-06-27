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
				<a href="{{ route('files_s_registros.files_s_registro.index') }}">{{ trans('files_s_registros.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('files_s_registros.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_s_registros.files_s_registro.destroy', $filesSRegistro->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_s_registros.files_s_registro.index')
                    <a href="{{ route('files_s_registros.files_s_registro.index') }}" class="btn btn-primary" title="{{ trans('files_s_registros.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_registros.files_s_registro.create')
                    <a href="{{ route('files_s_registros.files_s_registro.create') }}" class="btn btn-success" title="{{ trans('files_s_registros.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_registros.files_s_registro.edit')
                    <a href="{{ route('files_s_registros.files_s_registro.edit', $filesSRegistro->id ) }}" class="btn btn-primary" title="{{ trans('files_s_registros.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_registros.files_s_registro.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_s_registros.delete') }}" onclick="return confirm(&quot;{{ trans('files_s_registros.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_s_registros.file_path') }}</dt>
            <dd>{{ $filesSRegistro->file_path }}</dd>
            <dt>{{ trans('files_s_registros.descripcion') }}</dt>
            <dd>{{ $filesSRegistro->descripcion }}</dd>
            <dt>{{ trans('files_s_registros.s_registro_id') }}</dt>
            <dd>{{ optional($filesSRegistro->sRegistro)->detalle }}</dd>
            <dt>{{ trans('files_s_registros.created_at') }}</dt>
            <dd>{{ $filesSRegistro->created_at }}</dd>
            <dt>{{ trans('files_s_registros.updated_at') }}</dt>
            <dd>{{ $filesSRegistro->updated_at }}</dd>
            <dt>{{ trans('files_s_registros.deleted_at') }}</dt>
            <dd>{{ $filesSRegistro->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection