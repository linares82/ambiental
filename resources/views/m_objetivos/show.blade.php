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
				<a href="{{ route('m_objetivos.m_objetivo.index') }}">{{ trans('m_objetivos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('m_objetivos.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('m_objetivos.m_objetivo.destroy', $mObjetivo->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('m_objetivos.m_objetivo.index')
                    <a href="{{ route('m_objetivos.m_objetivo.index') }}" class="btn btn-primary" title="{{ trans('m_objetivos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_objetivos.m_objetivo.create')
                    <a href="{{ route('m_objetivos.m_objetivo.create') }}" class="btn btn-success" title="{{ trans('m_objetivos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_objetivos.m_objetivo.edit')
                    <a href="{{ route('m_objetivos.m_objetivo.edit', $mObjetivo->id ) }}" class="btn btn-primary" title="{{ trans('m_objetivos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_objetivos.m_objetivo.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('m_objetivos.delete') }}" onclick="return confirm(&quot;{{ trans('m_objetivos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('m_objetivos.objetivo') }}</dt>
            <dd>{{ $mObjetivo->objetivo }}</dd>
            <dt>{{ trans('m_objetivos.usu_alta_id') }}</dt>
            <dd>{{ optional($mObjetivo->user)->name }}</dd>
            <dt>{{ trans('m_objetivos.usu_mod_id') }}</dt>
            <dd>{{ optional($mObjetivo->user)->name }}</dd>
            <dt>{{ trans('m_objetivos.created_at') }}</dt>
            <dd>{{ $mObjetivo->created_at }}</dd>
            <dt>{{ trans('m_objetivos.updated_at') }}</dt>
            <dd>{{ $mObjetivo->updated_at }}</dd>
            <dt>{{ trans('m_objetivos.deleted_at') }}</dt>
            <dd>{{ $mObjetivo->deleted_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection