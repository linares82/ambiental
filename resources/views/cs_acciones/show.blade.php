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
				<a href="{{ route('cs_acciones.cs_accione.index') }}">{{ trans('cs_acciones.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_acciones.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_acciones.cs_accione.destroy', $csAccione->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_acciones.cs_accione.index')
                    <a href="{{ route('cs_acciones.cs_accione.index') }}" class="btn btn-primary" title="{{ trans('cs_acciones.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_acciones.cs_accione.create')
                    <a href="{{ route('cs_acciones.cs_accione.create') }}" class="btn btn-success" title="{{ trans('cs_acciones.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_acciones.cs_accione.edit')
                    <a href="{{ route('cs_acciones.cs_accione.edit', $csAccione->id ) }}" class="btn btn-primary" title="{{ trans('cs_acciones.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_acciones.cs_accione.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_acciones.delete') }}" onclick="return confirm(&quot;{{ trans('cs_acciones.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_acciones.accion') }}</dt>
            <dd>{{ $csAccione->accion }}</dd>
            <dt>{{ trans('cs_acciones.usu_alta_id') }}</dt>
            <dd>{{ optional($csAccione->user)->name }}</dd>
            <dt>{{ trans('cs_acciones.usu_mod_id') }}</dt>
            <dd>{{ optional($csAccione->user)->name }}</dd>
            <dt>{{ trans('cs_acciones.created_at') }}</dt>
            <dd>{{ $csAccione->created_at }}</dd>
            <dt>{{ trans('cs_acciones.updated_at') }}</dt>
            <dd>{{ $csAccione->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection