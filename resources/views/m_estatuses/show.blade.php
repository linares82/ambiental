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
				<a href="{{ route('m_estatuses.m_estatus.index') }}">{{ trans('m_estatuses.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('m_estatuses.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('m_estatuses.m_estatus.destroy', $mEstatus->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('m_estatuses.m_estatus.index')
                    <a href="{{ route('m_estatuses.m_estatus.index') }}" class="btn btn-primary" title="{{ trans('m_estatuses.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_estatuses.m_estatus.create')
                    <a href="{{ route('m_estatuses.m_estatus.create') }}" class="btn btn-success" title="{{ trans('m_estatuses.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_estatuses.m_estatus.edit')
                    <a href="{{ route('m_estatuses.m_estatus.edit', $mEstatus->id ) }}" class="btn btn-primary" title="{{ trans('m_estatuses.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_estatuses.m_estatus.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('m_estatuses.delete') }}" onclick="return confirm(&quot;{{ trans('m_estatuses.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('m_estatuses.estatus') }}</dt>
            <dd>{{ $mEstatus->estatus }}</dd>
            <dt>{{ trans('m_estatuses.usu_mod_id') }}</dt>
            <dd>{{ optional($mEstatus->usuMod)->id }}</dd>
            <dt>{{ trans('m_estatuses.usu_alta_id') }}</dt>
            <dd>{{ optional($mEstatus->usuAltum)->id }}</dd>
            <dt>{{ trans('m_estatuses.created_at') }}</dt>
            <dd>{{ $mEstatus->created_at }}</dd>
            <dt>{{ trans('m_estatuses.updated_at') }}</dt>
            <dd>{{ $mEstatus->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection