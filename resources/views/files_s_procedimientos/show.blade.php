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
				<a href="{{ route('files_s_procedimientos.files_s_procedimiento.index') }}">{{ trans('files_s_procedimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('files_s_procedimientos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_s_procedimientos.files_s_procedimiento.destroy', $filesSProcedimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_s_procedimientos.files_s_procedimiento.index')
                    <a href="{{ route('files_s_procedimientos.files_s_procedimiento.index') }}" class="btn btn-primary" title="{{ trans('files_s_procedimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_procedimientos.files_s_procedimiento.create')
                    <a href="{{ route('files_s_procedimientos.files_s_procedimiento.create') }}" class="btn btn-success" title="{{ trans('files_s_procedimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_procedimientos.files_s_procedimiento.edit')
                    <a href="{{ route('files_s_procedimientos.files_s_procedimiento.edit', $filesSProcedimiento->id ) }}" class="btn btn-primary" title="{{ trans('files_s_procedimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_s_procedimientos.files_s_procedimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_s_procedimientos.delete') }}" onclick="return confirm(&quot;{{ trans('files_s_procedimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_s_procedimientos.file_path') }}</dt>
            <dd>{{ $filesSProcedimiento->file_path }}</dd>
            <dt>{{ trans('files_s_procedimientos.descripcion') }}</dt>
            <dd>{{ $filesSProcedimiento->descripcion }}</dd>
            <dt>{{ trans('files_s_procedimientos.s_procedimiento_id') }}</dt>
            <dd>{{ optional($filesSProcedimiento->sProcedimiento)->descripcion }}</dd>
            <dt>{{ trans('files_s_procedimientos.created_at') }}</dt>
            <dd>{{ $filesSProcedimiento->created_at }}</dd>
            <dt>{{ trans('files_s_procedimientos.updated_at') }}</dt>
            <dd>{{ $filesSProcedimiento->updated_at }}</dd>
            <dt>{{ trans('files_s_procedimientos.deleted_at') }}</dt>
            <dd>{{ $filesSProcedimiento->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection