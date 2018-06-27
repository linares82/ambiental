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
				<a href="{{ route('entities.entity.index') }}">{{ trans('entities.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Entity' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('entities.entity.destroy', $entity->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('entities.entity.index')
                    <a href="{{ route('entities.entity.index') }}" class="btn btn-primary" title="{{ trans('entities.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('entities.entity.create')
                    <a href="{{ route('entities.entity.create') }}" class="btn btn-success" title="{{ trans('entities.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('entities.entity.edit')
                    <a href="{{ route('entities.entity.edit', $entity->id ) }}" class="btn btn-primary" title="{{ trans('entities.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('entities.entity.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('entities.delete') }}" onclick="return confirm(&quot;{{ trans('entities.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('entities.rzon_social') }}</dt>
            <dd>{{ $entity->rzon_social }}</dd>
            <dt>{{ trans('entities.responsable') }}</dt>
            <dd>{{ $entity->responsable }}</dd>
            <dt>{{ trans('entities.dir1') }}</dt>
            <dd>{{ $entity->dir1 }}</dd>
            <dt>{{ trans('entities.dir2') }}</dt>
            <dd>{{ $entity->dir2 }}</dd>
            <dt>{{ trans('entities.rfc') }}</dt>
            <dd>{{ $entity->rfc }}</dd>
            <dt>{{ trans('entities.abreviatura') }}</dt>
            <dd>{{ $entity->abreviatura }}</dd>
            <dt>{{ trans('entities.logo') }}</dt>
            <dd>{{ $entity->logo }}</dd>
            <dt>{{ trans('entities.usu_alta_id') }}</dt>
            <dd>{{ optional($entity->user)->name }}</dd>
            <dt>{{ trans('entities.usu_mod_id') }}</dt>
            <dd>{{ optional($entity->user)->name }}</dd>
            <dt>{{ trans('entities.created_at') }}</dt>
            <dd>{{ $entity->created_at }}</dd>
            <dt>{{ trans('entities.updated_at') }}</dt>
            <dd>{{ $entity->updated_at }}</dd>
            <dt>{{ trans('entities.multi_entidad') }}</dt>
            <dd>
                @if($entity->multi_entidad==1) 
                Si
                @else
                No
                @endif
            </dd>
            
            

        </dl>

    </div>
</div>

@endsection