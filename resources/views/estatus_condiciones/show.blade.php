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
				<a href="{{ route('estatus_condiciones.estatus_condicione.index') }}">{{ trans('estatus_condiciones.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('estatus_condiciones.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('estatus_condiciones.estatus_condicione.destroy', $estatusCondicione->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('estatus_condiciones.estatus_condicione.index')
                    <a href="{{ route('estatus_condiciones.estatus_condicione.index') }}" class="btn btn-primary" title="{{ trans('estatus_condiciones.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estatus_condiciones.estatus_condicione.create')
                    <a href="{{ route('estatus_condiciones.estatus_condicione.create') }}" class="btn btn-success" title="{{ trans('estatus_condiciones.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estatus_condiciones.estatus_condicione.edit')
                    <a href="{{ route('estatus_condiciones.estatus_condicione.edit', $estatusCondicione->id ) }}" class="btn btn-primary" title="{{ trans('estatus_condiciones.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estatus_condiciones.estatus_condicione.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('estatus_condiciones.delete') }}" onclick="return confirm(&quot;{{ trans('estatus_condiciones.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('estatus_condiciones.estatus') }}</dt>
            <dd>{{ $estatusCondicione->estatus }}</dd>
            <dt>{{ trans('estatus_condiciones.usu_alta_id') }}</dt>
            <dd>{{ optional($estatusCondicione->user)->name }}</dd>
            <dt>{{ trans('estatus_condiciones.usu_mod_id') }}</dt>
            <dd>{{ optional($estatusCondicione->user)->name }}</dd>
            <dt>{{ trans('estatus_condiciones.created_at') }}</dt>
            <dd>{{ $estatusCondicione->created_at }}</dd>
            <dt>{{ trans('estatus_condiciones.updated_at') }}</dt>
            <dd>{{ $estatusCondicione->updated_at }}</dd>
            <dt>{{ trans('estatus_condiciones.deleted_at') }}</dt>
            <dd>{{ $estatusCondicione->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection