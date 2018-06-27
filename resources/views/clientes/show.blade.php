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
				<a href="{{ route('clientes.cliente.index') }}">{{ trans('clientes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Cliente' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('clientes.cliente.destroy', $cliente->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('clientes.cliente.index')
                    <a href="{{ route('clientes.cliente.index') }}" class="btn btn-primary" title="{{ trans('clientes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('clientes.cliente.create')
                    <a href="{{ route('clientes.cliente.create') }}" class="btn btn-success" title="{{ trans('clientes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('clientes.cliente.edit')
                    <a href="{{ route('clientes.cliente.edit', $cliente->id ) }}" class="btn btn-primary" title="{{ trans('clientes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('clientes.cliente.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('clientes.delete') }}" onclick="return confirm(&quot;{{ trans('clientes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('clientes.cliente') }}</dt>
            <dd>{{ $cliente->cliente }}</dd>
            <dt>{{ trans('clientes.usu_alta_id') }}</dt>
            <dd>{{ optional($cliente->user)->name }}</dd>
            <dt>{{ trans('clientes.usu_mod_id') }}</dt>
            <dd>{{ optional($cliente->user)->name }}</dd>
            <dt>{{ trans('clientes.created_at') }}</dt>
            <dd>{{ $cliente->created_at }}</dd>
            <dt>{{ trans('clientes.updated_at') }}</dt>
            <dd>{{ $cliente->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection