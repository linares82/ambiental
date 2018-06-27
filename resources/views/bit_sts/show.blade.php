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
				<a href="{{ route('bit_sts.bit_st.index') }}">{{ trans('bit_sts.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('bit_sts.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bit_sts.bit_st.destroy', $bitSt->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bit_sts.bit_st.index')
                    <a href="{{ route('bit_sts.bit_st.index') }}" class="btn btn-primary" title="{{ trans('bit_sts.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_sts.bit_st.create')
                    <a href="{{ route('bit_sts.bit_st.create') }}" class="btn btn-success" title="{{ trans('bit_sts.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_sts.bit_st.edit')
                    <a href="{{ route('bit_sts.bit_st.edit', $bitSt->id ) }}" class="btn btn-primary" title="{{ trans('bit_sts.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bit_sts.bit_st.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bit_sts.delete') }}" onclick="return confirm(&quot;{{ trans('bit_sts.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bit_sts.estatus') }}</dt>
            <dd>{{ $bitSt->estatus }}</dd>
            <dt>{{ trans('bit_sts.usu_alta_id') }}</dt>
            <dd>{{ optional($bitSt->user)->name }}</dd>
            <dt>{{ trans('bit_sts.usu_mod_id') }}</dt>
            <dd>{{ optional($bitSt->user)->name }}</dd>
            <dt>{{ trans('bit_sts.created_at') }}</dt>
            <dd>{{ $bitSt->created_at }}</dd>
            <dt>{{ trans('bit_sts.updated_at') }}</dt>
            <dd>{{ $bitSt->updated_at }}</dd>
            <dt>{{ trans('bit_sts.deleted_at') }}</dt>
            <dd>{{ $bitSt->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection