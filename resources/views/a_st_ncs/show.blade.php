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
				<a href="{{ route('a_st_ncs.a_st_nc.index') }}">{{ trans('a_st_ncs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('a_st_ncs.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_st_ncs.a_st_nc.destroy', $aStNc->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_st_ncs.a_st_nc.index')
                    <a href="{{ route('a_st_ncs.a_st_nc.index') }}" class="btn btn-primary" title="{{ trans('a_st_ncs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_st_ncs.a_st_nc.create')
                    <a href="{{ route('a_st_ncs.a_st_nc.create') }}" class="btn btn-success" title="{{ trans('a_st_ncs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_st_ncs.a_st_nc.edit')
                    <a href="{{ route('a_st_ncs.a_st_nc.edit', $aStNc->id ) }}" class="btn btn-primary" title="{{ trans('a_st_ncs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_st_ncs.a_st_nc.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_st_ncs.delete') }}" onclick="return confirm(&quot;{{ trans('a_st_ncs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_st_ncs.estatus') }}</dt>
            <dd>{{ $aStNc->estatus }}</dd>
            <dt>{{ trans('a_st_ncs.usu_alta_id') }}</dt>
            <dd>{{ optional($aStNc->user)->name }}</dd>
            <dt>{{ trans('a_st_ncs.usu_mod_id') }}</dt>
            <dd>{{ optional($aStNc->user)->name }}</dd>
            <dt>{{ trans('a_st_ncs.created_at') }}</dt>
            <dd>{{ $aStNc->created_at }}</dd>
            <dt>{{ trans('a_st_ncs.updated_at') }}</dt>
            <dd>{{ $aStNc->updated_at }}</dd>
            <dt>{{ trans('a_st_ncs.deleted_at') }}</dt>
            <dd>{{ $aStNc->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection