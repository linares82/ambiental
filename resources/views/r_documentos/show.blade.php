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
				<a href="{{ route('r_documentos.r_documento.index') }}">{{ trans('r_documentos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('r_documentos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('r_documentos.r_documento.destroy', $rDocumento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('r_documentos.r_documento.index')
                    <a href="{{ route('r_documentos.r_documento.index') }}" class="btn btn-primary" title="{{ trans('r_documentos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('r_documentos.r_documento.create')
                    <a href="{{ route('r_documentos.r_documento.create') }}" class="btn btn-success" title="{{ trans('r_documentos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('r_documentos.r_documento.edit')
                    <a href="{{ route('r_documentos.r_documento.edit', $rDocumento->id ) }}" class="btn btn-primary" title="{{ trans('r_documentos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('r_documentos.r_documento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('r_documentos.delete') }}" onclick="return confirm(&quot;{{ trans('r_documentos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('r_documentos.tpo_documento_id') }}</dt>
            <dd>{{ optional($rDocumento->tpoDoc)->tpo_doc }}</dd>
            <dt>{{ trans('r_documentos.r_documento') }}</dt>
            <dd>{{ $rDocumento->r_documento }}</dd>
            <dt>{{ trans('r_documentos.usu_alta_id') }}</dt>
            <dd>{{ optional($rDocumento->user)->name }}</dd>
            <dt>{{ trans('r_documentos.usu_mod_id') }}</dt>
            <dd>{{ optional($rDocumento->user)->name }}</dd>
            <dt>{{ trans('r_documentos.created_at') }}</dt>
            <dd>{{ $rDocumento->created_at }}</dd>
            <dt>{{ trans('r_documentos.updated_at') }}</dt>
            <dd>{{ $rDocumento->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection