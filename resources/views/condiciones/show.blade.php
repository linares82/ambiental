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
				<a href="{{ route('condiciones.condicione.index') }}">{{ trans('condiciones.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('condiciones.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('condiciones.condicione.destroy', $condicione->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('condiciones.condicione.index')
                    <a href="{{ route('condiciones.condicione.index') }}" class="btn btn-primary" title="{{ trans('condiciones.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('condiciones.condicione.create')
                    <a href="{{ route('condiciones.condicione.create') }}" class="btn btn-success" title="{{ trans('condiciones.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('condiciones.condicione.edit')
                    <a href="{{ route('condiciones.condicione.edit', $condicione->id ) }}" class="btn btn-primary" title="{{ trans('condiciones.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('condiciones.condicione.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('condiciones.delete') }}" onclick="return confirm(&quot;{{ trans('condiciones.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('condiciones.impacto_id') }}</dt>
            <dd>{{ optional($condicione->aaImpacto)->impacto }}</dd>
            <dt>{{ trans('condiciones.condicion') }}</dt>
            <dd>{{ $condicione->condicion }}</dd>
            <dt>{{ trans('condiciones.usu_alta_id') }}</dt>
            <dd>{{ optional($condicione->user)->name }}</dd>
            <dt>{{ trans('condiciones.usu_mod_id') }}</dt>
            <dd>{{ optional($condicione->user)->name }}</dd>
            <dt>{{ trans('condiciones.created_at') }}</dt>
            <dd>{{ $condicione->created_at }}</dd>
            <dt>{{ trans('condiciones.updated_at') }}</dt>
            <dd>{{ $condicione->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection