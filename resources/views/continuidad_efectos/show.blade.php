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
				<a href="{{ route('continuidad_efectos.continuidad_efecto.index') }}">{{ trans('continuidad_efectos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('continuidad_efectos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('continuidad_efectos.continuidad_efecto.destroy', $continuidadEfecto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('continuidad_efectos.continuidad_efecto.index')
                    <a href="{{ route('continuidad_efectos.continuidad_efecto.index') }}" class="btn btn-primary" title="{{ trans('continuidad_efectos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('continuidad_efectos.continuidad_efecto.create')
                    <a href="{{ route('continuidad_efectos.continuidad_efecto.create') }}" class="btn btn-success" title="{{ trans('continuidad_efectos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('continuidad_efectos.continuidad_efecto.edit')
                    <a href="{{ route('continuidad_efectos.continuidad_efecto.edit', $continuidadEfecto->id ) }}" class="btn btn-primary" title="{{ trans('continuidad_efectos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('continuidad_efectos.continuidad_efecto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('continuidad_efectos.delete') }}" onclick="return confirm(&quot;{{ trans('continuidad_efectos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('continuidad_efectos.continuidad_efecto') }}</dt>
            <dd>{{ $continuidadEfecto->continuidad_efecto }}</dd>
            <dt>{{ trans('continuidad_efectos.usu_alta_id') }}</dt>
            <dd>{{ optional($continuidadEfecto->user)->name }}</dd>
            <dt>{{ trans('continuidad_efectos.usu_mod_id') }}</dt>
            <dd>{{ optional($continuidadEfecto->user)->name }}</dd>
            <dt>{{ trans('continuidad_efectos.created_at') }}</dt>
            <dd>{{ $continuidadEfecto->created_at }}</dd>
            <dt>{{ trans('continuidad_efectos.updated_at') }}</dt>
            <dd>{{ $continuidadEfecto->updated_at }}</dd>
            <dt>{{ trans('continuidad_efectos.deleted_at') }}</dt>
            <dd>{{ $continuidadEfecto->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection