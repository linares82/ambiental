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
				<a href="{{ route('cs_tpo_deteccions.cs_tpo_deteccion.index') }}">{{ trans('cs_tpo_deteccions.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('cs_tpo_deteccions.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_tpo_deteccions.cs_tpo_deteccion.destroy', $csTpoDeteccion->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_tpo_deteccions.cs_tpo_deteccion.index')
                    <a href="{{ route('cs_tpo_deteccions.cs_tpo_deteccion.index') }}" class="btn btn-primary" title="{{ trans('cs_tpo_deteccions.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_deteccions.cs_tpo_deteccion.create')
                    <a href="{{ route('cs_tpo_deteccions.cs_tpo_deteccion.create') }}" class="btn btn-success" title="{{ trans('cs_tpo_deteccions.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_deteccions.cs_tpo_deteccion.edit')
                    <a href="{{ route('cs_tpo_deteccions.cs_tpo_deteccion.edit', $csTpoDeteccion->id ) }}" class="btn btn-primary" title="{{ trans('cs_tpo_deteccions.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_deteccions.cs_tpo_deteccion.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_tpo_deteccions.delete') }}" onclick="return confirm(&quot;{{ trans('cs_tpo_deteccions.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_tpo_deteccions.tpo_deteccion') }}</dt>
            <dd>{{ $csTpoDeteccion->tpo_deteccion }}</dd>
            <dt>{{ trans('cs_tpo_deteccions.usu_alta_id') }}</dt>
            <dd>{{ optional($csTpoDeteccion->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_deteccions.usu_mod_id') }}</dt>
            <dd>{{ optional($csTpoDeteccion->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_deteccions.created_at') }}</dt>
            <dd>{{ $csTpoDeteccion->created_at }}</dd>
            <dt>{{ trans('cs_tpo_deteccions.updated_at') }}</dt>
            <dd>{{ $csTpoDeteccion->updated_at }}</dd>
            <dt>{{ trans('cs_tpo_deteccions.deleted_at') }}</dt>
            <dd>{{ $csTpoDeteccion->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection