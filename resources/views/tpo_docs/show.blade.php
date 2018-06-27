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
				<a href="{{ route('tpo_docs.tpo_doc.index') }}">{{ trans('tpo_docs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('tpo_docs.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('tpo_docs.tpo_doc.destroy', $tpoDoc->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('tpo_docs.tpo_doc.index')
                    <a href="{{ route('tpo_docs.tpo_doc.index') }}" class="btn btn-primary" title="{{ trans('tpo_docs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tpo_docs.tpo_doc.create')
                    <a href="{{ route('tpo_docs.tpo_doc.create') }}" class="btn btn-success" title="{{ trans('tpo_docs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tpo_docs.tpo_doc.edit')
                    <a href="{{ route('tpo_docs.tpo_doc.edit', $tpoDoc->id ) }}" class="btn btn-primary" title="{{ trans('tpo_docs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tpo_docs.tpo_doc.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('tpo_docs.delete') }}" onclick="return confirm(&quot;{{ trans('tpo_docs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('tpo_docs.tpo_doc') }}</dt>
            <dd>{{ $tpoDoc->tpo_doc }}</dd>
            <dt>{{ trans('tpo_docs.usu_alta_id') }}</dt>
            <dd>{{ optional($tpoDoc->user)->name }}</dd>
            <dt>{{ trans('tpo_docs.usu_mod_id') }}</dt>
            <dd>{{ optional($tpoDoc->user)->name }}</dd>
            <dt>{{ trans('tpo_docs.created_at') }}</dt>
            <dd>{{ $tpoDoc->created_at }}</dd>
            <dt>{{ trans('tpo_docs.updated_at') }}</dt>
            <dd>{{ $tpoDoc->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection