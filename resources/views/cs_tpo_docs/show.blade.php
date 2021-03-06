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
				<a href="{{ route('cs_tpo_docs.cs_tpo_doc.index') }}">{{ trans('cs_tpo_docs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_tpo_docs.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_tpo_docs.cs_tpo_doc.destroy', $csTpoDoc->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_tpo_docs.cs_tpo_doc.index')
                    <a href="{{ route('cs_tpo_docs.cs_tpo_doc.index') }}" class="btn btn-primary" title="{{ trans('cs_tpo_docs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_docs.cs_tpo_doc.create')
                    <a href="{{ route('cs_tpo_docs.cs_tpo_doc.create') }}" class="btn btn-success" title="{{ trans('cs_tpo_docs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_docs.cs_tpo_doc.edit')
                    <a href="{{ route('cs_tpo_docs.cs_tpo_doc.edit', $csTpoDoc->id ) }}" class="btn btn-primary" title="{{ trans('cs_tpo_docs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_docs.cs_tpo_doc.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_tpo_docs.delete') }}" onclick="return confirm(&quot;{{ trans('cs_tpo_docs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_tpo_docs.tpo_procedimiento_id') }}</dt>
            <dd>{{ optional($csTpoDoc->csTpoProcedimiento)->tpo_procedimiento }}</dd>
            <dt>{{ trans('cs_tpo_docs.tpo_doc') }}</dt>
            <dd>{{ $csTpoDoc->tpo_doc }}</dd>
            <dt>{{ trans('cs_tpo_docs.usu_alta_id') }}</dt>
            <dd>{{ optional($csTpoDoc->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_docs.usu_mod_id') }}</dt>
            <dd>{{ optional($csTpoDoc->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_docs.created_at') }}</dt>
            <dd>{{ $csTpoDoc->created_at }}</dd>
            <dt>{{ trans('cs_tpo_docs.updated_at') }}</dt>
            <dd>{{ $csTpoDoc->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection