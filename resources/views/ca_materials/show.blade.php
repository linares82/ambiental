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
				<a href="{{ route('ca_materials.ca_material.index') }}">{{ trans('ca_materials.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_materials.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_materials.ca_material.destroy', $caMaterial->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_materials.ca_material.index')
                    <a href="{{ route('ca_materials.ca_material.index') }}" class="btn btn-primary" title="{{ trans('ca_materials.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_materials.ca_material.create')
                    <a href="{{ route('ca_materials.ca_material.create') }}" class="btn btn-success" title="{{ trans('ca_materials.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_materials.ca_material.edit')
                    <a href="{{ route('ca_materials.ca_material.edit', $caMaterial->id ) }}" class="btn btn-primary" title="{{ trans('ca_materials.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_materials.ca_material.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_materials.delete') }}" onclick="return confirm(&quot;{{ trans('ca_materials.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_materials.material') }}</dt>
            <dd>{{ $caMaterial->material }}</dd>
            <dt>{{ trans('ca_materials.usu_alta_id') }}</dt>
            <dd>{{ optional($caMaterial->user)->name }}</dd>
            <dt>{{ trans('ca_materials.usu_mod_id') }}</dt>
            <dd>{{ optional($caMaterial->user)->name }}</dd>
            <dt>{{ trans('ca_materials.created_at') }}</dt>
            <dd>{{ $caMaterial->created_at }}</dd>
            <dt>{{ trans('ca_materials.updated_at') }}</dt>
            <dd>{{ $caMaterial->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection