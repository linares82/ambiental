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
				<a href="{{ route('imp_potencials.imp_potencial.index') }}">{{ trans('imp_potencials.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('imp_potencials.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('imp_potencials.imp_potencial.destroy', $impPotencial->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('imp_potencials.imp_potencial.index')
                    <a href="{{ route('imp_potencials.imp_potencial.index') }}" class="btn btn-primary" title="{{ trans('imp_potencials.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('imp_potencials.imp_potencial.create')
                    <a href="{{ route('imp_potencials.imp_potencial.create') }}" class="btn btn-success" title="{{ trans('imp_potencials.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('imp_potencials.imp_potencial.edit')
                    <a href="{{ route('imp_potencials.imp_potencial.edit', $impPotencial->id ) }}" class="btn btn-primary" title="{{ trans('imp_potencials.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('imp_potencials.imp_potencial.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('imp_potencials.delete') }}" onclick="return confirm(&quot;{{ trans('imp_potencials.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('imp_potencials.imp_potencial') }}</dt>
            <dd>{{ $impPotencial->imp_potencial }}</dd>
            <dt>{{ trans('imp_potencials.descripcion') }}</dt>
            <dd>{{ $impPotencial->descripcion }}</dd>
            <dt>{{ trans('imp_potencials.usu_alta_id') }}</dt>
            <dd>{{ optional($impPotencial->user)->name }}</dd>
            <dt>{{ trans('imp_potencials.usu_mod_id') }}</dt>
            <dd>{{ optional($impPotencial->user)->name }}</dd>
            <dt>{{ trans('imp_potencials.created_at') }}</dt>
            <dd>{{ $impPotencial->created_at }}</dd>
            <dt>{{ trans('imp_potencials.updated_at') }}</dt>
            <dd>{{ $impPotencial->updated_at }}</dd>
            <dt>{{ trans('imp_potencials.deleted_at') }}</dt>
            <dd>{{ $impPotencial->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection