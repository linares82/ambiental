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
				<a href="{{ route('files_rev_documental_lns.files_rev_documental_ln.index') }}">{{ trans('files_rev_documental_lns.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('files_rev_documental_lns.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_rev_documental_lns.files_rev_documental_ln.destroy', $filesRevDocumentalLn->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_rev_documental_lns.files_rev_documental_ln.index')
                    <a href="{{ route('files_rev_documental_lns.files_rev_documental_ln.index') }}" class="btn btn-primary" title="{{ trans('files_rev_documental_lns.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_rev_documental_lns.files_rev_documental_ln.create')
                    <a href="{{ route('files_rev_documental_lns.files_rev_documental_ln.create') }}" class="btn btn-success" title="{{ trans('files_rev_documental_lns.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_rev_documental_lns.files_rev_documental_ln.edit')
                    <a href="{{ route('files_rev_documental_lns.files_rev_documental_ln.edit', $filesRevDocumentalLn->id ) }}" class="btn btn-primary" title="{{ trans('files_rev_documental_lns.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_rev_documental_lns.files_rev_documental_ln.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_rev_documental_lns.delete') }}" onclick="return confirm(&quot;{{ trans('files_rev_documental_lns.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_rev_documental_lns.file_path') }}</dt>
            <dd>{{ $filesRevDocumentalLn->file_path }}</dd>
            <dt>{{ trans('files_rev_documental_lns.descripcion') }}</dt>
            <dd>{{ $filesRevDocumentalLn->descripcion }}</dd>
            <dt>{{ trans('files_rev_documental_lns.rev_documental_ln_id') }}</dt>
            <dd>{{ optional($filesRevDocumentalLn->revDocumentalLn)->dias_advertencia1 }}</dd>
            <dt>{{ trans('files_rev_documental_lns.created_at') }}</dt>
            <dd>{{ $filesRevDocumentalLn->created_at }}</dd>
            <dt>{{ trans('files_rev_documental_lns.updated_at') }}</dt>
            <dd>{{ $filesRevDocumentalLn->updated_at }}</dd>
            <dt>{{ trans('files_rev_documental_lns.deleted_at') }}</dt>
            <dd>{{ $filesRevDocumentalLn->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection