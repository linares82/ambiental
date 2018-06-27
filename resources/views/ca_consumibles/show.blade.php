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
				<a href="{{ route('ca_consumibles.ca_consumible.index') }}">{{ trans('ca_consumibles.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_consumibles.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_consumibles.ca_consumible.destroy', $caConsumible->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_consumibles.ca_consumible.index')
                    <a href="{{ route('ca_consumibles.ca_consumible.index') }}" class="btn btn-primary" title="{{ trans('ca_consumibles.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_consumibles.ca_consumible.create')
                    <a href="{{ route('ca_consumibles.ca_consumible.create') }}" class="btn btn-success" title="{{ trans('ca_consumibles.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_consumibles.ca_consumible.edit')
                    <a href="{{ route('ca_consumibles.ca_consumible.edit', $caConsumible->id ) }}" class="btn btn-primary" title="{{ trans('ca_consumibles.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_consumibles.ca_consumible.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_consumibles.delete') }}" onclick="return confirm(&quot;{{ trans('ca_consumibles.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_consumibles.consumible') }}</dt>
            <dd>{{ $caConsumible->consumible }}</dd>
            <dt>{{ trans('ca_consumibles.unidad') }}</dt>
            <dd>{{ $caConsumible->unidad }}</dd>
            <dt>{{ trans('ca_consumibles.usu_alta_id') }}</dt>
            <dd>{{ optional($caConsumible->user)->name }}</dd>
            <dt>{{ trans('ca_consumibles.usu_mod_id') }}</dt>
            <dd>{{ optional($caConsumible->user)->name }}</dd>
            <dt>{{ trans('ca_consumibles.created_at') }}</dt>
            <dd>{{ $caConsumible->created_at }}</dd>
            <dt>{{ trans('ca_consumibles.updated_at') }}</dt>
            <dd>{{ $caConsumible->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection