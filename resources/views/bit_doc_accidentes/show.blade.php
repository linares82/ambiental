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
				<a href="{{ route('bit_doc_accidentes.bit_doc_accidente.index') }}">{{ trans('bit_doc_accidentes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('bit_doc_accidentes.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bit_doc_accidentes.bit_doc_accidente.destroy', $bitDocAccidente->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bit_doc_accidentes.bit_doc_accidente.index')
                    <a href="{{ route('bit_doc_accidentes.bit_doc_accidente.index') }}" class="btn btn-primary" title="{{ trans('bit_doc_accidentes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_doc_accidentes.bit_doc_accidente.create')
                    <a href="{{ route('bit_doc_accidentes.bit_doc_accidente.create') }}" class="btn btn-success" title="{{ trans('bit_doc_accidentes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_doc_accidentes.bit_doc_accidente.edit')
                    <a href="{{ route('bit_doc_accidentes.bit_doc_accidente.edit', $bitDocAccidente->id ) }}" class="btn btn-primary" title="{{ trans('bit_doc_accidentes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_doc_accidentes.bit_doc_accidente.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bit_doc_accidentes.delete') }}" onclick="return confirm(&quot;{{ trans('bit_doc_accidentes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bit_doc_accidentes.bitacora_accidente_id') }}</dt>
            <dd>{{ optional($bitDocAccidente->bitacoraAccidente)->descripcion }}</dd>
            <dt>{{ trans('bit_doc_accidentes.documento') }}</dt>
            <dd>{{ $bitDocAccidente->documento }}</dd>
            <dt>{{ trans('bit_doc_accidentes.archivo') }}</dt>
            <dd>{{ $bitDocAccidente->archivo }}</dd>
            <dt>{{ trans('bit_doc_accidentes.created_at') }}</dt>
            <dd>{{ $bitDocAccidente->created_at }}</dd>
            <dt>{{ trans('bit_doc_accidentes.updated_at') }}</dt>
            <dd>{{ $bitDocAccidente->updated_at }}</dd>
            <dt>{{ trans('bit_doc_accidentes.deleted_at') }}</dt>
            <dd>{{ $bitDocAccidente->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection