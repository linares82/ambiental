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
				<a href="{{ route('puestos.puesto.index') }}">{{ trans('puestos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Puesto' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('puestos.puesto.destroy', $puesto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('puestos.puesto.index')
                    <a href="{{ route('puestos.puesto.index') }}" class="btn btn-primary" title="{{ trans('puestos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('puestos.puesto.create')
                    <a href="{{ route('puestos.puesto.create') }}" class="btn btn-success" title="{{ trans('puestos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('puestos.puesto.edit')
                    <a href="{{ route('puestos.puesto.edit', $puesto->id ) }}" class="btn btn-primary" title="{{ trans('puestos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('puestos.puesto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('puestos.delete') }}" onclick="return confirm(&quot;{{ trans('puestos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('puestos.puesto') }}</dt>
            <dd>{{ $puesto->puesto }}</dd>
            <dt>{{ trans('puestos.usu_alta_id') }}</dt>
            <dd>{{ optional($puesto->user)->name }}</dd>
            <dt>{{ trans('puestos.usu_mod_id') }}</dt>
            <dd>{{ optional($puesto->user)->name }}</dd>
            <dt>{{ trans('puestos.created_at') }}</dt>
            <dd>{{ $puesto->created_at }}</dd>
            <dt>{{ trans('puestos.updated_at') }}</dt>
            <dd>{{ $puesto->updated_at }}</dd>
            

        </dl>

    </div>
</div>

@endsection