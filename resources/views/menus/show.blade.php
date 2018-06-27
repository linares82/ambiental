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
				<a href="{{ route('menus.menu.index') }}">{{ trans('menus.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Menu' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('menus.menu.destroy', $menu->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('menus.menu.index') }}" class="btn btn-primary" title="{{ trans('menus.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('menus.menu.create') }}" class="btn btn-success" title="{{ trans('menus.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('menus.menu.edit', $menu->id ) }}" class="btn btn-primary" title="{{ trans('menus.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('menus.delete') }}" onclick="return confirm(&quot;{{ trans('menus.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('menus.item') }}</dt>
            <dd>{{ $menu->item }}</dd>
            <dt>{{ trans('menus.orden') }}</dt>
            <dd>{{ $menu->orden }}</dd>
            <dt>{{ trans('menus.depende_de') }}</dt>
            <dd>{{ $menu->depende_de }}</dd>
            <dt>{{ trans('menus.link') }}</dt>
            <dd>{{ $menu->link }}</dd>
            <dt>{{ trans('menus.permiso_id') }}</dt>
            <dd>{{ optional($menu->permiso)->id }}</dd>
            <dt>{{ trans('menus.target') }}</dt>
            <dd>{{ $menu->target }}</dd>
            <dt>{{ trans('menus.created_at') }}</dt>
            <dd>{{ $menu->created_at }}</dd>
            <dt>{{ trans('menus.updated_at') }}</dt>
            <dd>{{ $menu->updated_at }}</dd>
            <dt>{{ trans('menus.deleted_at') }}</dt>
            <dd>{{ $menu->deleted_at }}</dd>
            <dt>{{ trans('menus.usu_alta_id') }}</dt>
            <dd>{{ optional($menu->user)->id }}</dd>
            <dt>{{ trans('menus.usu_mod_id') }}</dt>
            <dd>{{ optional($menu->user)->id }}</dd>
            <dt>{{ trans('menus.activo') }}</dt>
            <dd>{{ $menu->activo }}</dd>
            <dt>{{ trans('menus.imagen') }}</dt>
            <dd>{{ $menu->imagen }}</dd>

        </dl>

    </div>
</div>

@endsection