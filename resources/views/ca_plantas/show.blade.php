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
				<a href="{{ route('ca_plantas.ca_planta.index') }}">{{ trans('ca_plantas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_plantas.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_plantas.ca_planta.destroy', $caPlanta->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_plantas.ca_planta.index')
                    <a href="{{ route('ca_plantas.ca_planta.index') }}" class="btn btn-primary" title="{{ trans('ca_plantas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_plantas.ca_planta.create')
                    <a href="{{ route('ca_plantas.ca_planta.create') }}" class="btn btn-success" title="{{ trans('ca_plantas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_plantas.ca_planta.edit')
                    <a href="{{ route('ca_plantas.ca_planta.edit', $caPlanta->id ) }}" class="btn btn-primary" title="{{ trans('ca_plantas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_plantas.ca_planta.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_plantas.delete') }}" onclick="return confirm(&quot;{{ trans('ca_plantas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_plantas.planta') }}</dt>
            <dd>{{ $caPlanta->planta }}</dd>
            <dt>{{ trans('ca_plantas.ubicacion') }}</dt>
            <dd>{{ $caPlanta->ubicacion }}</dd>
            <dt>{{ trans('ca_plantas.obs') }}</dt>
            <dd>{{ $caPlanta->obs }}</dd>
            <dt>{{ trans('ca_plantas.tipo_planta') }}</dt>
            <dd>{{ $caPlanta->tipo_planta }}</dd>
            <dt>{{ trans('ca_plantas.c_tratamiento') }}</dt>
            <dd>{{ $caPlanta->c_tratamiento }}</dd>
            <dt>{{ trans('ca_plantas.usu_alta_id') }}</dt>
            <dd>{{ optional($caPlanta->user)->name }}</dd>
            <dt>{{ trans('ca_plantas.usu_mod_id') }}</dt>
            <dd>{{ optional($caPlanta->user)->name }}</dd>
            <dt>{{ trans('ca_plantas.created_at') }}</dt>
            <dd>{{ $caPlanta->created_at }}</dd>
            <dt>{{ trans('ca_plantas.updated_at') }}</dt>
            <dd>{{ $caPlanta->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection