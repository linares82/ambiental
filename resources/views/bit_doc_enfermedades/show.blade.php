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
				<a href="{{ route('bit_doc_enfermedades.bit_doc_enfermedade.index') }}">{{ trans('bit_doc_enfermedades.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('bit_doc_enfermedades.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bit_doc_enfermedades.bit_doc_enfermedade.destroy', $bitDocEnfermedade->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bit_doc_enfermedades.bit_doc_enfermedade.index')
                    <a href="{{ route('bit_doc_enfermedades.bit_doc_enfermedade.index') }}" class="btn btn-primary" title="{{ trans('bit_doc_enfermedades.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_doc_enfermedades.bit_doc_enfermedade.create')
                    <a href="{{ route('bit_doc_enfermedades.bit_doc_enfermedade.create') }}" class="btn btn-success" title="{{ trans('bit_doc_enfermedades.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_doc_enfermedades.bit_doc_enfermedade.edit')
                    <a href="{{ route('bit_doc_enfermedades.bit_doc_enfermedade.edit', $bitDocEnfermedade->id ) }}" class="btn btn-primary" title="{{ trans('bit_doc_enfermedades.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_doc_enfermedades.bit_doc_enfermedade.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bit_doc_enfermedades.delete') }}" onclick="return confirm(&quot;{{ trans('bit_doc_enfermedades.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bit_doc_enfermedades.bitacora_enfermedade_id') }}</dt>
            <dd>{{ optional($bitDocEnfermedade->bitacoraEnfermedade)->descripcion }}</dd>
            <dt>{{ trans('bit_doc_enfermedades.documento') }}</dt>
            <dd>{{ $bitDocEnfermedade->documento }}</dd>
            <dt>{{ trans('bit_doc_enfermedades.archivo') }}</dt>
            <dd>{{ $bitDocEnfermedade->archivo }}</dd>
            <dt>{{ trans('bit_doc_enfermedades.created_at') }}</dt>
            <dd>{{ $bitDocEnfermedade->created_at }}</dd>
            <dt>{{ trans('bit_doc_enfermedades.updated_at') }}</dt>
            <dd>{{ $bitDocEnfermedade->updated_at }}</dd>
            <dt>{{ trans('bit_doc_enfermedades.deleted_at') }}</dt>
            <dd>{{ $bitDocEnfermedade->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection