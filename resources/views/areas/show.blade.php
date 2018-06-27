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
				<a href="{{ route('areas.area.index') }}">{{ trans('areas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Area' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('areas.area.destroy', $area->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('areas.area.index')
                    <a href="{{ route('areas.area.index') }}" class="btn btn-primary" title="{{ trans('areas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('areas.area.create')
                    <a href="{{ route('areas.area.create') }}" class="btn btn-success" title="{{ trans('areas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('areas.area.edit')
                    <a href="{{ route('areas.area.edit', $area->id ) }}" class="btn btn-primary" title="{{ trans('areas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('areas.area.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('areas.delete') }}" onclick="return confirm(&quot;{{ trans('areas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('areas.area') }}</dt>
            <dd>{{ $area->area }}</dd>
            <dt>{{ trans('areas.usu_alta_id') }}</dt>
            <dd>{{ optional($area->user)->name }}</dd>
            <dt>{{ trans('areas.usu_mod_id') }}</dt>
            <dd>{{ optional($area->user)->name }}</dd>
            <dt>{{ trans('areas.entity_id') }}</dt>
            <dd>{{ optional($area->entity)->rzon_social }}</dd>
            <dt>{{ trans('areas.created_at') }}</dt>
            <dd>{{ $area->created_at }}</dd>
            <dt>{{ trans('areas.updated_at') }}</dt>
            <dd>{{ $area->updated_at }}</dd>
            

        </dl>

    </div>
</div>

@endsection