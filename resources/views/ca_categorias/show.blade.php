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
				<a href="{{ route('ca_categorias.ca_categoria.index') }}">{{ trans('ca_categorias.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_categorias.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_categorias.ca_categoria.destroy', $caCategoria->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_categorias.ca_categoria.index')
                    <a href="{{ route('ca_categorias.ca_categoria.index') }}" class="btn btn-primary" title="{{ trans('ca_categorias.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_categorias.ca_categoria.create')
                    <a href="{{ route('ca_categorias.ca_categoria.create') }}" class="btn btn-success" title="{{ trans('ca_categorias.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_categorias.ca_categoria.edit')
                    <a href="{{ route('ca_categorias.ca_categoria.edit', $caCategoria->id ) }}" class="btn btn-primary" title="{{ trans('ca_categorias.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_categorias.ca_categoria.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_categorias.delete') }}" onclick="return confirm(&quot;{{ trans('ca_categorias.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_categorias.ca_material_id') }}</dt>
            <dd>{{ optional($caCategoria->caMaterial)->material }}</dd>
            <dt>{{ trans('ca_categorias.categoria') }}</dt>
            <dd>{{ $caCategoria->categoria }}</dd>
            <dt>{{ trans('ca_categorias.usu_alta_id') }}</dt>
            <dd>{{ optional($caCategoria->user)->name }}</dd>
            <dt>{{ trans('ca_categorias.usu_mod_id') }}</dt>
            <dd>{{ optional($caCategoria->user)->name }}</dd>
            <dt>{{ trans('ca_categorias.created_at') }}</dt>
            <dd>{{ $caCategoria->created_at }}</dd>
            <dt>{{ trans('ca_categorias.updated_at') }}</dt>
            <dd>{{ $caCategoria->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection