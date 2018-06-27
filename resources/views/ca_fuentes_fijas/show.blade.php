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
				<a href="{{ route('ca_fuentes_fijas.ca_fuentes_fija.index') }}">{{ trans('ca_fuentes_fijas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_fuentes_fijas.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_fuentes_fijas.ca_fuentes_fija.destroy', $caFuentesFija->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_fuentes_fijas.ca_fuentes_fija.index')
                    <a href="{{ route('ca_fuentes_fijas.ca_fuentes_fija.index') }}" class="btn btn-primary" title="{{ trans('ca_fuentes_fijas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_fuentes_fijas.ca_fuentes_fija.create')
                    <a href="{{ route('ca_fuentes_fijas.ca_fuentes_fija.create') }}" class="btn btn-success" title="{{ trans('ca_fuentes_fijas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_fuentes_fijas.ca_fuentes_fija.edit')
                    <a href="{{ route('ca_fuentes_fijas.ca_fuentes_fija.edit', $caFuentesFija->id ) }}" class="btn btn-primary" title="{{ trans('ca_fuentes_fijas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_fuentes_fijas.ca_fuentes_fija.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_fuentes_fijas.delete') }}" onclick="return confirm(&quot;{{ trans('ca_fuentes_fijas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_fuentes_fijas.planta') }}</dt>
            <dd>{{ $caFuentesFija->planta }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.marca') }}</dt>
            <dd>{{ $caFuentesFija->marca }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.ubicacion') }}</dt>
            <dd>{{ $caFuentesFija->ubicacion }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.obs') }}</dt>
            <dd>{{ $caFuentesFija->obs }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.c_termica') }}</dt>
            <dd>{{ $caFuentesFija->c_termica }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.tipo_combustible') }}</dt>
            <dd>{{ $caFuentesFija->tipo_combustible }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.usu_alta_id') }}</dt>
            <dd>{{ optional($caFuentesFija->user)->name }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.usu_mod_id') }}</dt>
            <dd>{{ optional($caFuentesFija->user)->name }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.created_at') }}</dt>
            <dd>{{ $caFuentesFija->created_at }}</dd>
            <dt>{{ trans('ca_fuentes_fijas.updated_at') }}</dt>
            <dd>{{ $caFuentesFija->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection