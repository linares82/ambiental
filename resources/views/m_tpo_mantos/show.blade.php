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
				<a href="{{ route('m_tpo_mantos.m_tpo_manto.index') }}">{{ trans('m_tpo_mantos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('m_tpo_mantos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('m_tpo_mantos.m_tpo_manto.destroy', $mTpoManto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('m_tpo_mantos.m_tpo_manto.index')
                    <a href="{{ route('m_tpo_mantos.m_tpo_manto.index') }}" class="btn btn-primary" title="{{ trans('m_tpo_mantos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_tpo_mantos.m_tpo_manto.create')
                    <a href="{{ route('m_tpo_mantos.m_tpo_manto.create') }}" class="btn btn-success" title="{{ trans('m_tpo_mantos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_tpo_mantos.m_tpo_manto.edit')
                    <a href="{{ route('m_tpo_mantos.m_tpo_manto.edit', $mTpoManto->id ) }}" class="btn btn-primary" title="{{ trans('m_tpo_mantos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('m_tpo_mantos.m_tpo_manto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('m_tpo_mantos.delete') }}" onclick="return confirm(&quot;{{ trans('m_tpo_mantos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('m_tpo_mantos.tpo_manto') }}</dt>
            <dd>{{ $mTpoManto->tpo_manto }}</dd>
            <dt>{{ trans('m_tpo_mantos.usu_alta_id') }}</dt>
            <dd>{{ optional($mTpoManto->user)->name }}</dd>
            <dt>{{ trans('m_tpo_mantos.usu_mod_id') }}</dt>
            <dd>{{ optional($mTpoManto->user)->name }}</dd>
            <dt>{{ trans('m_tpo_mantos.created_at') }}</dt>
            <dd>{{ $mTpoManto->created_at }}</dd>
            <dt>{{ trans('m_tpo_mantos.updated_at') }}</dt>
            <dd>{{ $mTpoManto->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection