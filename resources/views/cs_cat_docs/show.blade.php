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
				<a href="{{ route('cs_cat_docs.cs_cat_doc.index') }}">{{ trans('cs_cat_docs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_cat_docs.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_cat_docs.cs_cat_doc.destroy', $csCatDoc->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_cat_docs.cs_cat_doc.index')
                    <a href="{{ route('cs_cat_docs.cs_cat_doc.index') }}" class="btn btn-primary" title="{{ trans('cs_cat_docs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_cat_docs.cs_cat_doc.create')
                    <a href="{{ route('cs_cat_docs.cs_cat_doc.create') }}" class="btn btn-success" title="{{ trans('cs_cat_docs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_cat_docs.cs_cat_doc.edit')
                    <a href="{{ route('cs_cat_docs.cs_cat_doc.edit', $csCatDoc->id ) }}" class="btn btn-primary" title="{{ trans('cs_cat_docs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_cat_docs.cs_cat_doc.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_cat_docs.delete') }}" onclick="return confirm(&quot;{{ trans('cs_cat_docs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_cat_docs.cat_doc') }}</dt>
            <dd>{{ $csCatDoc->cat_doc }}</dd>
            <dt>{{ trans('cs_cat_docs.usu_alta_id') }}</dt>
            <dd>{{ optional($csCatDoc->user)->name }}</dd>
            <dt>{{ trans('cs_cat_docs.usu_mod_id') }}</dt>
            <dd>{{ optional($csCatDoc->user)->name }}</dd>
            <dt>{{ trans('cs_cat_docs.created_at') }}</dt>
            <dd>{{ $csCatDoc->created_at }}</dd>
            <dt>{{ trans('cs_cat_docs.updated_at') }}</dt>
            <dd>{{ $csCatDoc->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection