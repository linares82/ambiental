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
				<a href="{{ route('files_a_procedimientos.files_a_procedimiento.index') }}">{{ trans('files_a_procedimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('files_a_procedimientos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_a_procedimientos.files_a_procedimiento.destroy', $filesAProcedimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_a_procedimientos.files_a_procedimiento.index')
                    <a href="{{ route('files_a_procedimientos.files_a_procedimiento.index') }}" class="btn btn-primary" title="{{ trans('files_a_procedimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_procedimientos.files_a_procedimiento.create')
                    <a href="{{ route('files_a_procedimientos.files_a_procedimiento.create') }}" class="btn btn-success" title="{{ trans('files_a_procedimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_procedimientos.files_a_procedimiento.edit')
                    <a href="{{ route('files_a_procedimientos.files_a_procedimiento.edit', $filesAProcedimiento->id ) }}" class="btn btn-primary" title="{{ trans('files_a_procedimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_procedimientos.files_a_procedimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_a_procedimientos.delete') }}" onclick="return confirm(&quot;{{ trans('files_a_procedimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_a_procedimientos.file_path') }}</dt>
            <dd>{{ $filesAProcedimiento->file_path }}</dd>
            <dt>{{ trans('files_a_procedimientos.descripcion') }}</dt>
            <dd>{{ $filesAProcedimiento->descripcion }}</dd>
            <dt>{{ trans('files_a_procedimientos.a_procedimiento_id') }}</dt>
            <dd>{{ optional($filesAProcedimiento->aProcedimiento)->descripcion }}</dd>
            <dt>{{ trans('files_a_procedimientos.created_at') }}</dt>
            <dd>{{ $filesAProcedimiento->created_at }}</dd>
            <dt>{{ trans('files_a_procedimientos.updated_at') }}</dt>
            <dd>{{ $filesAProcedimiento->updated_at }}</dd>
            <dt>{{ trans('files_a_procedimientos.deleted_at') }}</dt>
            <dd>{{ $filesAProcedimiento->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection