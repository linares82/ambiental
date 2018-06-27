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
				<a href="{{ route('ca_aa_docs.ca_aa_doc.index') }}">{{ trans('ca_aa_docs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_aa_docs.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_aa_docs.ca_aa_doc.destroy', $caAaDoc->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_aa_docs.ca_aa_doc.index')
                    <a href="{{ route('ca_aa_docs.ca_aa_doc.index') }}" class="btn btn-primary" title="{{ trans('ca_aa_docs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_aa_docs.ca_aa_doc.create')
                    <a href="{{ route('ca_aa_docs.ca_aa_doc.create') }}" class="btn btn-success" title="{{ trans('ca_aa_docs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_aa_docs.ca_aa_doc.edit')
                    <a href="{{ route('ca_aa_docs.ca_aa_doc.edit', $caAaDoc->id ) }}" class="btn btn-primary" title="{{ trans('ca_aa_docs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_aa_docs.ca_aa_doc.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_aa_docs.delete') }}" onclick="return confirm(&quot;{{ trans('ca_aa_docs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_aa_docs.material_id') }}</dt>
            <dd>{{ optional($caAaDoc->caMaterial)->material }}</dd>
            <dt>{{ trans('ca_aa_docs.categoria_id') }}</dt>
            <dd>{{ optional($caAaDoc->caCategoria)->categoria }}</dd>
            <dt>{{ trans('ca_aa_docs.doc') }}</dt>
            <dd>{{ $caAaDoc->doc }}</dd>
            <dt>{{ trans('ca_aa_docs.usu_alta_id') }}</dt>
            <dd>{{ optional($caAaDoc->user)->name }}</dd>
            <dt>{{ trans('ca_aa_docs.usu_mod_id') }}</dt>
            <dd>{{ optional($caAaDoc->user)->name }}</dd>
            <dt>{{ trans('ca_aa_docs.created_at') }}</dt>
            <dd>{{ $caAaDoc->created_at }}</dd>
            <dt>{{ trans('ca_aa_docs.updated_at') }}</dt>
            <dd>{{ $caAaDoc->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection