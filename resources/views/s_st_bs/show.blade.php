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
				<a href="{{ route('s_st_bs.s_st_b.index') }}">{{ trans('s_st_bs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('s_st_bs.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('s_st_bs.s_st_b.destroy', $sStB->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('s_st_bs.s_st_b.index')
                    <a href="{{ route('s_st_bs.s_st_b.index') }}" class="btn btn-primary" title="{{ trans('s_st_bs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_st_bs.s_st_b.create')
                    <a href="{{ route('s_st_bs.s_st_b.create') }}" class="btn btn-success" title="{{ trans('s_st_bs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_st_bs.s_st_b.edit')
                    <a href="{{ route('s_st_bs.s_st_b.edit', $sStB->id ) }}" class="btn btn-primary" title="{{ trans('s_st_bs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('s_st_bs.s_st_b.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('s_st_bs.delete') }}" onclick="return confirm(&quot;{{ trans('s_st_bs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('s_st_bs.estatus') }}</dt>
            <dd>{{ $sStB->estatus }}</dd>
            <dt>{{ trans('s_st_bs.usu_alta_id') }}</dt>
            <dd>{{ optional($sStB->user)->name }}</dd>
            <dt>{{ trans('s_st_bs.usu_mod_id') }}</dt>
            <dd>{{ optional($sStB->user)->name }}</dd>
            <dt>{{ trans('s_st_bs.created_at') }}</dt>
            <dd>{{ $sStB->created_at }}</dd>
            <dt>{{ trans('s_st_bs.updated_at') }}</dt>
            <dd>{{ $sStB->updated_at }}</dd>
            <dt>{{ trans('s_st_bs.deleted_at') }}</dt>
            <dd>{{ $sStB->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection